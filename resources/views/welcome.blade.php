<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-4xl font-bold mb-8 text-center">Eventos Disponíveis</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($events as $event)
                <div class="card bg-base-100 shadow-xl border border-gray-200 flex flex-col justify-between">
                    
            <figure class="w-full h-52 overflow-hidden bg-gray-200">
                @if($event->banner_path)
                    @if(str_starts_with($event->banner_path, 'http'))
                        <img src="{{ $event->banner_path }}" alt="{{ $event->title }}" class="w-full h-full object-cover object-center" />
                    @else
                        <img src="{{ asset('storage/' . $event->banner_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover object-center" />
                    @endif
                @else
                    <img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?q=80&w=600" alt="Banner Padrão" class="w-full h-full object-cover object-center" />
                @endif
            </figure>

                    <div class="card-body flex-grow">
                        <h2 class="card-title text-xl font-bold text-gray-800">{{ $event->title }}</h2>
                        <div class="badge badge-secondary my-1">{{ $event->category->name }}</div>
                        <p class="text-gray-600 text-sm line-clamp-3 mt-2">{{ $event->description }}</p>
                        
                        <div class="card-actions justify-end mt-4 pt-4 border-t border-gray-100">
                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary btn-sm">Ver Detalhes</a>                        
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>