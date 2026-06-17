<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\View\View;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(): View
    {
        // Buscando todos os eventos e carregamos a categoria de uma vez só (Eager Loading)
        $events = Event::with('category')->orderBy('date_time', 'asc')->get();

        return view('welcome', ['events' => $events]);
    }

    public function dashboard(): \Illuminate\View\View
    {
        $user = auth()->user();

        // Se for organizador, busca os eventos que ELE CRIOU
        if ($user->role === 'organizer') {
            $events = $user->organizedEvents()->orderBy('date_time', 'desc')->get();
            return view('dashboard', compact('events'));
        }

        // Se for participante, busca os eventos que ELE VAI PARTICIPAR (Ingressos)
        $tickets = $user->attendingEvents()->orderBy('date_time', 'asc')->get();
        return view('dashboard', compact('tickets'));
    }

    public function create(): View
{
    $categories = \App\Models\Category::all();
    return view('events.create', compact('categories'));
}

public function store(StoreEventRequest $request)
{

    if (!$request->user()) {
        return redirect()->route('login');
    }

// Valida o upload da imagem
    if ($request->hasFile('banner')) {
        $path = $request->file('banner')->store('banners', 'public');
    } else {
        return back()->withErrors(['banner' => 'Erro ao enviar imagem.']);
    }

    // 3. Criamos o evento associado ao usuário logado (Segurança de Propriedade)
    $request->user()->organizedEvents()->create([
        'title' => $request->title,
        'description' => $request->description,
        'date_time' => $request->date_time,
        'location' => $request->location,
        'capacity' => $request->capacity,
        'category_id' => $request->category_id,
        'banner_path' => $path,
    ]);

    return redirect()->route('dashboard')->with('success', 'Evento criado com sucesso!');
}


public function edit(Event $event)
    {
        // Segurança: Garante que o organizador só edita o que é dele
        if ($event->user_id !== auth()->id()) {
            abort(403, 'Você não tem permissão para editar este evento.');
        }

        $categories = \App\Models\Category::all();
        return view('events.edit', compact('event', 'categories'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        if ($event->user_id !== auth()->id()) {
            abort(403, 'Você não tem permissão para editar este evento.');
        }

        $data = $request->validated();

        // Se o usuário enviou uma nova imagem
        if ($request->hasFile('banner')) {
            // Apaga a imagem antiga do disco (se não for link de internet)
            if ($event->banner_path && !str_starts_with($event->banner_path, 'http')) {
                Storage::disk('public')->delete($event->banner_path);
            }
            // Salva a nova imagem
            $data['banner_path'] = $request->file('banner')->store('banners', 'public');
        }

        $event->update($data);

        return redirect()->route('dashboard')->with('success', 'Evento atualizado com sucesso!');
    }


    public function destroy(Event $event)
    {
        // Segurança Nível 1: Só o dono do evento pode apagá-lo
        if ($event->user_id !== auth()->id()) {
            abort(403, 'Você não tem permissão para excluir este evento.');
        }

        // Segurança Nível 2: Limpar o HD! Apagamos a imagem do storage antes de apagar o registro
        if ($event->banner_path && !str_starts_with($event->banner_path, 'http')) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($event->banner_path);
        }

        // Apaga o evento do banco de dados
        $event->delete();

        return redirect()->route('dashboard')->with('success', 'Evento excluído com sucesso!');
    }


    public function show(Event $event): \Illuminate\View\View
    {
        // O Laravel já busca o evento automaticamente no banco através da injeção de dependência (Event $event)
        // Vamos apenas garantir que a categoria também é carregada para mostrar na tela
        $event->load('category');
        
        return view('events.show', compact('event'));
    }


    public function attend(Event $event)
    {
        $user = auth()->user();

        // Regra 1: O dono do evento não compra ingresso do próprio evento
        if ($event->user_id === $user->id) {
            return back()->with('error', 'Você é o organizador deste evento.');
        }

        // Regra 2: Verifica se o usuário já tem ingresso
        if ($event->participants()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Você já possui ingresso para este evento!');
        }

        // Regra 3: Verifica se ainda há vagas
        if ($event->participants()->count() >= $event->capacity) {
            return back()->with('error', 'Desculpe, os ingressos estão esgotados.');
        }

        // Gera um código de ingresso aleatório (Ex: TKT-A1B2C3)
        $ticketCode = 'TKT-' . strtoupper(substr(uniqid(), -6));

        // Salva na tabela pivô (Inscreve o usuário no evento)
        $event->participants()->attach($user->id, [
            'ticket_code' => $ticketCode,
            'status' => 'confirmed'
        ]);

        return redirect()->route('dashboard')->with('success', 'Inscrição confirmada! Seu ingresso foi gerado com sucesso.');
    }


    public function cancel(Event $event)
    {
        $user = auth()->user();

        // Segurança: Verifica se o usuário realmente está inscrito antes de tentar cancelar
        if (!$event->participants()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Você não está inscrito neste evento.');
        }

        // Remove a ligação entre o usuário e o evento na tabela pivô (libera a vaga)
        $event->participants()->detach($user->id);

        return redirect()->route('dashboard')->with('success', 'Inscrição cancelada com sucesso. A sua vaga foi libertada!');
    }
}
