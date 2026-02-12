<form wire:submit.prevent="store"
      enctype="multipart/form-data"
      class="card p-4 shadow">


    
    <div class="mb-3">
        <label class="form-label">Titolo</label>
        <input type="text" class="form-control" wire:model="title">
        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

   
    <div class="mb-3">
        <label class="form-label">Descrizione</label>
        <textarea class="form-control" wire:model="description"></textarea>
        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    
    <div class="mb-3">
        <label class="form-label">Prezzo</label>
        <input type="number" class="form-control" wire:model="price">
        @error('price') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    
    <div class="mb-3">
        <label class="form-label">Categoria</label>
        <select class="form-control" wire:model="category_id">
            <option value="">Seleziona categoria</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

   
    <div class="mb-3">
    <label class="form-label">Immagini</label>

    <input type="file"
           class="form-control"
           wire:model="temporary_images"
           multiple
           accept="image/*">

    <div class="form-text">
        📸 Puoi caricare fino a <strong>6 immagini</strong>.<br>
        📐 Dimensione consigliata: <strong>1200x800 px</strong> (formato orizzontale).<br>
        ⚖️ Peso massimo per immagine: <strong>1MB</strong>.
    </div>

    @error('temporary_images.*')
        <span class="text-danger d-block">{{ $message }}</span>
    @enderror

    @error('temporary_images')
        <span class="text-danger d-block">{{ $message }}</span>
    @enderror
</div>

    
    @if(!empty($images))
        <div class="row">
            @foreach($images as $key => $image)
                <div class="col-3 mb-3 text-center">
                    <img src="{{ $image->temporaryUrl() }}"
                         class="img-fluid rounded shadow"
                         style="height:150px; object-fit:cover;">

                    <button type="button"
                            class="btn btn-sm btn-danger mt-2"
                            wire:click="removeImage({{ $key }})">
                        Rimuovi
                    </button>
                </div>
            @endforeach
        </div>
    @endif

    <button class="btn btn-primary w-100 mt-3">
        Crea Annuncio
    </button>

</form>
