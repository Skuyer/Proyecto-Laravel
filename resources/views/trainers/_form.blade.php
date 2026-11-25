<div class="mb-3">
    <label class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
           value="{{ old('nombre', $trainer->nombre ?? '') }}">
    @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Apellido</label>
    <input type="text" name="apellido" class="form-control @error('apellido') is-invalid @enderror"
           value="{{ old('apellido', $trainer->apellido ?? '') }}">
    @error('apellido') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Foto</label>

    @if(isset($trainer) && $trainer->foto)
        <div class="mb-2">
            <img src="{{ asset('storage/'.$trainer->foto) }}" class="rounded-circle"
                 style="width:90px;height:90px;object-fit:cover;">
        </div>
    @endif

    <input type="file" name="foto" class="form-control" accept="image/*">
    @error('foto')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<button class="btn btn-primary">Guardar</button>
<a href="{{ route('trainers.index') }}" class="btn btn-secondary">Cancelar</a>