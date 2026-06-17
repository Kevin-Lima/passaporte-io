<x-app-layout>
    <div class="flex items-center justify-center min-h-[80vh] px-4 py-10">
        <div class="card lg:card-side bg-base-100 shadow-2xl max-w-5xl w-full border border-base-200 overflow-hidden">
            
            <figure class="hidden lg:block lg:w-1/2 relative bg-gray-900">
                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=800" alt="Evento" class="object-cover w-full h-full absolute inset-0 opacity-80" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent flex flex-col justify-end p-12 text-white">
                    <h2 class="text-4xl font-black mb-3 leading-tight">Viva momentos<br>inesquecíveis.</h2>
                    <p class="text-lg text-white/80">Acesse sua conta e garanta seu lugar nos melhores eventos ou gerencie suas próprias criações.</p>
                </div>
            </figure>

            <div class="card-body lg:w-1/2 p-8 md:p-14 justify-center">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-black text-base-content">Bem-vindo de volta</h2>
                    <p class="text-base-content/60 mt-2">Insira seus dados para acessar o sistema.</p>
                </div>

                <x-auth-session-status class="mb-4 text-error font-bold text-center" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-control w-full mb-5">
                        <label class="label font-semibold"><span class="label-text">E-mail</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus class="input input-bordered w-full focus:border-primary bg-base-200/50" placeholder="seu@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-error text-sm" />
                    </div>

                    <div class="form-control w-full mb-2" x-data="{ show: false }">
                        <label class="label font-semibold"><span class="label-text">Senha</span></label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" name="password" required class="input input-bordered w-full focus:border-primary bg-base-200/50 pr-10" placeholder="••••••••" />
                            
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-primary">
                                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg x-show="show" style="display: none;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-error text-sm" />
                    </div>

                    <div class="flex items-center justify-between mb-8 px-1">
                        <label class="cursor-pointer label gap-2">
                            <input type="checkbox" name="remember" class="checkbox checkbox-primary checkbox-sm" />
                            <span class="label-text">Lembrar de mim</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-primary hover:underline font-medium" href="{{ route('password.request') }}">
                                Esqueceu a senha?
                            </a>
                        @endif
                    </div>

                    <div class="form-control mt-2">
                        <button type="submit" class="btn btn-primary w-full text-lg shadow-lg shadow-primary/30">Entrar na Plataforma</button>
                    </div>

                    <div class="text-center mt-8">
                        <p class="text-base-content/70">
                            Ainda não tem conta? 
                            <a href="{{ route('register') }}" class="text-primary font-bold hover:underline transition-all">Crie uma agora</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>