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

<button class="btn btn-primary">Guardar</button>
<a href="{{ route('trainers.index') }}" class="btn btn-secondary">Cancelar</a>