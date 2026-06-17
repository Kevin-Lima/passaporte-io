<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importe o Auth explicitamente
use Symfony\Component\HttpFoundation\Response;

class CheckOrganizer
{
    public function handle(Request $request, Closure $next)
{
    // Verifica se o usuário não está autenticado
    if (!auth()->check()) {
        abort(401, 'Você não está logado.');
    }

    // Verifica a role
    if (auth()->user()->role !== 'organizer') {
        abort(403, 'Acesso permitido apenas para Organizadores. Sua role é: ' . auth()->user()->role);
    }

    return $next($request);
}
}