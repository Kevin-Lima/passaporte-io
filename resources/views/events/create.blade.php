<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-base-content leading-tight">
                Publicar Novo Evento
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
                <p class="text-base-content/70 mb-6 text-lg">Preencha os detalhes abaixo para criar o seu evento e começar a receber inscrições.</p>
                
                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-control w-full">
                            <label class="label font-semibold"><span class="label-text">Título do Evento</span></label>
                            <input type="text" name="title" value="{{ old('title') }}" class="input input-bordered w-full focus:border-primary" placeholder="Ex: Workshop de Laravel" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2 text-error text-sm" />
                        </div>

                        <div class="form-control w-full">
                            <label class="label font-semibold"><span class="label-text">Categoria</span></label>
                            <select name="category_id" class="select select-bordered w-full focus:border-primary" required>
                                <option value="" disabled selected>Selecione uma categoria...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2 text-error text-sm" />
                        </div>
                    </div>

                    <div class="form-control w-full mt-6">
                        <label class="label font-semibold"><span class="label-text">Descrição Completa</span></label>
                        <textarea name="description" class="textarea textarea-bordered h-32 focus:border-primary" placeholder="Descreva o que vai acontecer no evento, quem são os palestrantes, cronograma, etc." required>{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2 text-error text-sm" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div class="form-control">
                            <label class="label font-semibold"><span class="label-text">Data e Hora</span></label>
                            <input type="datetime-local" name="date_time" value="{{ old('date_time') }}" class="input input-bordered focus:border-primary" required />
                            <x-input-error :messages="$errors->get('date_time')" class="mt-2 text-error text-sm" />
                        </div>
                        
                        <div class="form-control">
                            <label class="label font-semibold"><span class="label-text">Vagas Disponíveis</span></label>
                            <input type="number" name="capacity" value="{{ old('capacity') }}" class="input input-bordered focus:border-primary" placeholder="Ex: 100" min="1" required />
                            <x-input-error :messages="$errors->get('capacity')" class="mt-2 text-error text-sm" />
                        </div>
                        
                        <div class="form-control">
                            <label class="label font-semibold"><span class="label-text">Local</span></label>
                            <input type="text" name="location" value="{{ old('location') }}" class="input input-bordered focus:border-primary" placeholder="Ex: Centro de Convenções" required />
                            <x-input-error :messages="$errors->get('location')" class="mt-2 text-error text-sm" />
                        </div>
                    </div>

                    <div class="form-control w-full mt-8 p-6 bg-base-200/50 rounded-xl border border-dashed border-base-300">
                        <label class="label font-bold pb-1"><span class="label-text text-lg">Banner do Evento <span class="text-error">*</span></span></label>
                        <label class="label text-sm text-base-content/60 pt-0 pb-4">Esta imagem será o destaque do seu evento na página inicial. (Resolução recomendada: 1920x1080px, Máx: 2MB).</label>
                        <input type="file" name="banner" class="file-input file-input-bordered file-input-primary w-full" accept="image/*" required />
                        <x-input-error :messages="$errors->get('banner')" class="mt-2 text-error text-sm" />
                    </div>

                    <div class="divider mt-8"></div>

                    <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 mt-4">
                        <a href="{{ route('dashboard') }}" class="btn btn-ghost">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-8">Publicar Evento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>