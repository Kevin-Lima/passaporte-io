<div class="navbar bg-base-100 shadow-sm sticky top-0 z-50 border-b border-base-200 px-4 sm:px-8">
    
    <div class="flex-1 gap-4">
        <a href="{{ route('home') }}" class="btn btn-ghost normal-case text-2xl font-black text-primary tracking-tight">
            Passaporte<span class="text-base-content">.io</span>
        </a>
        
        <div class="hidden md:flex gap-2 ml-4">
            <a href="{{ route('home') }}" class="btn btn-ghost btn-sm {{ request()->routeIs('home') ? 'btn-active' : '' }}">Explorar Eventos</a>
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-ghost btn-sm {{ request()->routeIs('dashboard') ? 'btn-active' : '' }}">Meu Painel</a>
            @endauth
        </div>
    </div>

    <div class="flex-none gap-2">
        @auth
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar border border-base-300">
                    <div class="w-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </label>
                <ul tabindex="0" class="mt-3 z-[1] p-2 shadow-xl menu menu-sm dropdown-content bg-base-100 rounded-box w-52 border border-base-200">
                    <li class="menu-title px-4 py-2">
                        <span class="font-bold text-base-content block">{{ Auth::user()->name }}</span>
                        <span class="text-xs font-normal text-gray-500 block capitalize">{{ Auth::user()->role === 'organizer' ? 'Organizador' : 'Participante' }}</span>
                    </li>
                    <li><div class="divider my-0"></div></li>
                    <li><a href="{{ route('dashboard') }}" class="py-3">Meu Painel</a></li>
                    <li><a href="{{ route('profile.edit') }}" class="py-3">Configurações</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="p-0 m-0 w-full">
                            @csrf
                            <button type="submit" class="w-full text-left py-3 px-4 text-error font-medium hover:bg-error/10 rounded-lg">
                                Sair do Sistema
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <div class="flex gap-2">
                <a href="{{ route('login') }}" class="btn btn-ghost">Entrar</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Criar Conta</a>
            </div>
        @endauth
    </div>
</div>