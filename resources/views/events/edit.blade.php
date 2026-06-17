<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-base-content leading-tight">
                Editar Evento: <span class="text-primary">{{ $event->title }}</span>
            </h2>
            <a href="{{ route('dashboard') }}" class="btn btn-ghost btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Voltar ao Painel
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8">
        <div class="card bg-base-100 shadow-xl border border-base-200">
            <div class="card-body">
                
                <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-control w-full">
                            <label class="label font-semibold"><span class="label-text">Título do Evento</span></label>
                            <input type="text" name="title" value="{{ old('title', $event->title) }}" class="input input-bordered w-full focus:border-primary" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2 text-error text-sm" />
                        </div>

                        <div class="form-control w-full">
                            <label class="label font-semibold"><span class="label-text">Categoria</span></label>
                            <select name="category_id" class="select select-bordered w-full focus:border-primary" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('category_id') ?? $event->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2 text-error text-sm" />
                        </div>
                    </div>

                    <div class="form-control w-full mt-6">
                        <label class="label font-semibold"><span class="label-text">Descrição Completa</span></label>
                        <textarea name="description" class="textarea textarea-bordered h-32 focus:border-primary" required>{{ old('description', $event->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2 text-error text-sm" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div class="form-control">
                            <label class="label font-semibold"><span class="label-text">Data e Hora</span></label>
                            <input type="datetime-local" name="date_time" value="{{ old('date_time', \Carbon\Carbon::parse($event->date_time)->format('Y-m-d\TH:i')) }}" class="input input-bordered focus:border-primary" required />
                            <x-input-error :messages="$errors->get('date_time')" class="mt-2 text-error text-sm" />
                        </div>
                        
                        <div class="form-control">
                            <label class="label font-semibold"><span class="label-text">Vagas Disponíveis</span></label>
                            <input type="number" name="capacity" value="{{ old('capacity', $event->capacity) }}" class="input input-bordered focus:border-primary" min="1" required />
                            <x-input-error :messages="$errors->get('capacity')" class="mt-2 text-error text-sm" />
                        </div>
                        
                        <div class="form-control">
                            <label class="label font-semibold"><span class="label-text">Local</span></label>
                            <input type="text" name="location" value="{{ old('location', $event->location) }}" class="input input-bordered focus:border-primary" required />
                            <x-input-error :messages="$errors->get('location')" class="mt-2 text-error text-sm" />
                        </div>
                    </div>

                    <div class="form-control w-full mt-8 p-6 bg-base-200/50 rounded-xl border border-dashed border-base-300">
                        <label class="label font-bold pb-4"><span class="label-text text-lg">Banner do Evento</span></label>
                        
                        <div class="flex flex-col md:flex-row gap-6 items-center">
                            <div class="w-48 h-28 rounded-lg overflow-hidden shadow-md flex-shrink-0 bg-base-100">
                                @if(str_starts_with($event->banner_path, 'http'))
                                    <img src="{{ $event->banner_path }}" alt="Banner Atual" class="w-full h-full object-cover" />
                                @else
                                    <img src="{{ asset('storage/' . $event->banner_path) }}" alt="Banner Atual" class="w-full h-full object-cover" />
                                @endif
                            </div>

                            <div class="w-full">
                                <label class="label text-sm text-base-content/70 pt-0 pb-2">Se quiser manter a imagem atual, deixe em branco. Para trocar, selecione uma nova imagem (Máx: 2MB).</label>
                                <input type="file" name="banner" class="file-input file-input-bordered file-input-primary w-full" accept="image/*" />
                                <x-input-error :messages="$errors->get('banner')" class="mt-2 text-error text-sm" />
                            </div>
                        </div>
                    </div>

                    <div class="divider mt-8"></div>

                    <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 mt-4">
                        <a href="{{ route('dashboard') }}" class="btn btn-ghost">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-8">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>