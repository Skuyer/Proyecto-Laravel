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

<table class="table table-bordered table-striped bg-white">
    <thead>
        <tr><th>ID</th><th>Nombre</th><th>Apellido</th><th width="180">Acciones</th></tr>
    </thead>
    <tbody>
        @forelse($trainers as $t)
        <tr>
            <td>{{ $t->id }}</td>
            <td>{{ $t->nombre }}</td>
            <td>{{ $t->apellido }}</td>
            <td>
                <a href="{{ route('trainers.edit', $t) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('trainers.destroy', $t) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('¿Eliminar este trainer?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="4" class="text-center">No se encontraron registros</td></tr>
        @endforelse
    </tbody>
</table>

{{ $trainers->links() }}
@endsection