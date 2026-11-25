@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Trainers</h2>
    <a href="{{ route('trainers.create') }}" class="btn btn-primary">Nuevo trainer</a>
</div>

<form method="GET" action="{{ route('trainers.index') }}" class="row g-2 mb-3">
    <div class="col-md-6">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control"
               placeholder="Buscar por nombre o apellido...">
    </div>
    <div class="col-auto">
        <button class="btn btn-secondary">Buscar</button>
        <a href="{{ route('trainers.index') }}" class="btn btn-outline-secondary">Limpiar</a>
    </div>
    <div class="col-auto ms-auto">
        <a href="{{ route('trainers.pdf', ['q' => request('q')]) }}" class="btn btn-danger">PDF</a>
        <a href="{{ route('trainers.excel', ['q' => request('q')]) }}" class="btn btn-success">Excel</a>
    </div>
</form>

<div class="row g-3 mb-3">
    @forelse($trainers as $t)
    <div class="col-12 col-md-6 col-xl-4">
        <div class="card shadow-sm h-100">
            <div class="row g-0 align-items-center h-100">
                <div class="col-4 text-center p-3">
                    <img src="{{ $t->foto ? asset('storage/'.$t->foto) : asset('images/sin-foto.png') }}"
                         alt="Foto de {{ $t->nombre }}"
                         class="rounded-circle"
                         style="width:90px;height:90px;object-fit:cover;">
                </div>
                <div class="col-8">
                    <div class="card-body">
                        <small class="text-muted">ID: {{ $t->id }}</small>
                        <h5 class="card-title mb-1">{{ $t->nombre }} {{ $t->apellido }}</h5>
                        <div class="mt-2">
                            <a href="{{ route('trainers.edit', $t) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('trainers.destroy', $t) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Eliminar este trainer?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-light text-center">No se encontraron registros</div>
    </div>
    @endforelse
</div>

{{ $trainers->links() }}
@endsection