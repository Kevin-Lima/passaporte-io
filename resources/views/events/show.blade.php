<x-app-layout>
    <div class="container mx-auto py-10 px-4">
        <div class="card lg:card-side bg-base-100 shadow-2xl overflow-hidden border border-base-200">
            
            <figure class="lg:w-1/2 w-full h-96 lg:h-auto">
                @if($event->banner_path)
                    @if(str_starts_with($event->banner_path, 'http'))
                        <img src="{{ $event->banner_path }}" alt="{{ $event->title }}" class="w-full h-full object-cover object-center" />
                    @else
                        <img src="{{ asset('storage/' . $event->banner_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover object-center" />
                    @endif
                @else
                    <img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?q=80&w=800" alt="Banner Padrão" class="w-full h-full object-cover object-center" />
                @endif
            </figure>

            <div class="card-body lg:w-1/2">
                <div class="badge badge-primary badge-outline mb-2">{{ $event->category->name }}</div>
                
                <h1 class="text-4xl font-black text-base-content mb-4">{{ $event->title }}</h1>
                
                <div class="flex flex-col gap-3 mb-6 text-gray-600">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        <span class="font-medium text-lg">{{ \Carbon\Carbon::parse($event->date_time)->format('d/m/Y \à\s H:i') }}</span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        <span class="text-lg">{{ $event->location }}</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        <span class="text-lg">{{ $event->capacity }} vagas disponíveis</span>
                    </div>
                </div>

                <div class="divider"></div>

                <h3 class="text-xl font-bold mb-2">Sobre o Evento</h3>
                <p class="text-gray-700 whitespace-pre-line mb-8">{{ $event->description }}</p>

                <div class="card-actions justify-end mt-auto">
                    
                    <div class="card-actions justify-end mt-auto">
                            @auth
                                <form action="{{ route('events.attend', $event->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-lg w-full md:w-auto">
                                        Garantir Meu Ingresso
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-full md:w-auto">
                                    Faça Login para Comprar
                                </a>
                            @endauth
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>