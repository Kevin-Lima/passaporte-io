<x-app-layout>
    <div class="flex items-center justify-center min-h-[80vh] px-4 py-10">
        <div class="card lg:card-side flex-row-reverse bg-base-100 shadow-2xl max-w-6xl w-full border border-base-200 overflow-hidden">
            
            <figure class="hidden lg:block lg:w-5/12 relative bg-gray-900">
                <img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?q=80&w=800" alt="Show ao vivo" class="object-cover w-full h-full absolute inset-0 opacity-70" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent flex flex-col justify-end p-12 text-white">
                    <h2 class="text-4xl font-black mb-3 leading-tight">Crie, participe,<br>viva a música.</h2>
                    <p class="text-lg text-white/80">Junte-se a milhares de pessoas que já usam nossa plataforma para transformar eventos em realidade.</p>
                </div>
            </figure>

            <div class="card-body lg:w-7/12 p-8 md:p-12 justify-center">
                <div class="mb-8">
                    <h2 class="text-3xl font-black text-base-content">Crie sua Conta</h2>
                    <p class="text-base-content/60 mt-2">Leva menos de um minuto para você começar.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div class="form-control w-full">
                            <label class="label font-semibold"><span class="label-text">Nome Completo</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required autofocus class="input input-bordered w-full focus:border-primary bg-base-200/50" placeholder="João Silva" />
                            <x-input-error :messages="$errors->get('name')" class="mt-1 text-error text-sm" />
                        </div>

                        <div class="form-control w-full">
                            <label class="label font-semibold"><span class="label-text">E-mail</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="input input-bordered w-full focus:border-primary bg-base-200/50" placeholder="seu@email.com" />
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-error text-sm" />
                        </div>
                    </div>

                    <div class="form-control w-full mb-5">
                        <label class="label font-semibold"><span class="label-text">O que você deseja fazer na plataforma?</span></label>
                        <select name="role" required class="select select-bordered w-full focus:border-primary bg-base-200/50 text-base">
                            <option value="participant" selected>Quero descobrir e comprar ingressos (Participante)</option>
                            <option value="organizer">Quero organizar os meus próprios eventos (Organizador)</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-1 text-error text-sm" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
                        <div class="form-control w-full" x-data="{ show: false }">
                            <label class="label font-semibold"><span class="label-text">Criar Senha</span></label>
                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" name="password" required class="input input-bordered w-full focus:border-primary bg-base-200/50 pr-10" placeholder="••••••••" />
                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-primary">
                                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                                    <svg x-show="show" style="display: none;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-error text-sm" />
                        </div>

                        <div class="form-control w-full" x-data="{ show: false }">
                            <label class="label font-semibold"><span class="label-text">Confirmar Senha</span></label>
                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" name="password_confirmation" required class="input input-bordered w-full focus:border-primary bg-base-200/50 pr-10" placeholder="••••••••" />
                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-primary">
                                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                                    <svg x-show="show" style="display: none;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-error text-sm" />
                        </div>
                    </div>

                    <div class="form-control mt-2">
                        <button type="submit" class="btn btn-primary w-full text-lg shadow-lg shadow-primary/30">Criar Minha Conta</button>
                    </div>

                    <div class="text-center mt-8 pt-4 border-t border-base-200">
                        <p class="text-base-content/70">
                            Já possui uma conta? 
                            <a href="{{ route('login') }}" class="text-primary font-bold hover:underline transition-all">Faça login aqui</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>