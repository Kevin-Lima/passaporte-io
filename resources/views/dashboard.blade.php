<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-base-content leading-tight">
            {{ __('Meu Painel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(auth()->user()->role === 'organizer')
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-base-content">Meus Eventos</h3>
                    <a href="{{ route('events.create') }}" class="btn btn-primary">
                        + Novo Evento
                    </a>
                </div>

                <div class="bg-base-100 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr class="bg-base-200">
                                    <th>Banner</th>
                                    <th>Título</th>
                                    <th>Data e Hora</th>
                                    <th>Vagas</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($events as $event)
                                    <tr class="hover">
                                        <td>
                                            <div class="avatar">
                                                <div class="w-16 h-16 rounded shadow">
                                                    @if(str_starts_with($event->banner_path, 'http'))
                                                        <img src="{{ $event->banner_path }}" alt="Banner" class="object-cover" />
                                                    @else
                                                        <img src="{{ asset('storage/' . $event->banner_path) }}" alt="Banner" class="object-cover" />
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="font-bold">{{ $event->title }}</td>
                                        <td>{{ \Carbon\Carbon::parse($event->date_time)->format('d/m/Y \à\s H:i') }}</td>
                                        <td>{{ $event->capacity }}</td>
                                        <td class="flex gap-2">
                                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-outline btn-info">Editar</a>
                                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este evento? Esta ação não pode ser desfeita.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline btn-error">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-8 text-gray-500">
                                            Você ainda não cadastrou nenhum evento.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
@else
                <div class="flex justify-between items-center mb-6 mt-8">
                    <h3 class="text-2xl font-bold text-base-content">Meus Ingressos</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($tickets as $ticket)
                        <div class="card bg-base-100 shadow-xl border border-base-200">
                            <figure class="w-full h-40 overflow-hidden bg-gray-200">
                                @if(str_starts_with($ticket->banner_path, 'http'))
                                    <img src="{{ $ticket->banner_path }}" alt="Banner" class="w-full h-full object-cover object-center" />
                                @else
                                    <img src="{{ asset('storage/' . $ticket->banner_path) }}" alt="Banner" class="w-full h-full object-cover object-center" />
                                @endif
                            </figure>

                            <div class="text-center bg-base-200 p-3 rounded-lg border border-dashed border-gray-400">
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Código do Ingresso</p>
                                <p class="text-2xl font-mono font-black tracking-widest text-primary">{{ $ticket->pivot->ticket_code }}</p>
                            </div>

                            <div class="mt-4 pt-4 border-t border-base-200">
                                <form action="{{ route('events.cancel', $ticket->id) }}" method="POST" onsubmit="return confirm('Tem a certeza que deseja cancelar a sua inscrição? Perderá o seu lugar no evento.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline btn-error btn-sm w-full">Cancelar Inscrição</button>
                                </form>
                            </div>
                            
                            <div class="card-body p-5">
                                <div class="badge badge-success mb-2 gap-1 text-white font-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                    Confirmado
                                </div>
                                <h2 class="card-title text-lg leading-tight">{{ $ticket->title }}</h2>
                                
                                <p class="text-sm text-gray-500 mt-2">
                                    📅 {{ \Carbon\Carbon::parse($ticket->date_time)->format('d/m/Y \à\s H:i') }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    📍 {{ $ticket->location }}
                                </p>
                                
                                <div class="divider my-2"></div>
                                
                                <div class="text-center bg-base-200 p-3 rounded-lg border border-dashed border-gray-400">
                                    <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Código do Ingresso</p>
                                    <p class="text-2xl font-mono font-black tracking-widest text-primary">{{ $ticket->pivot->ticket_code }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12 bg-base-100 rounded-lg shadow border border-base-200">
                            <h3 class="text-lg font-bold text-gray-600">Você ainda não possui ingressos.</h3>
                            <p class="text-gray-500 mb-4">Descubra eventos incríveis e garanta o seu lugar!</p>
                            <a href="{{ route('home') }}" class="btn btn-primary">Explorar Eventos</a>
                        </div>
                    @endforelse
                </div>
            @endif

        </div>
    </div>
</x-app-layout>