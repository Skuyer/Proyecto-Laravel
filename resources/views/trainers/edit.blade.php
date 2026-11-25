@extends('layouts.app')

@section('content')
<h2>Editar trainer</h2>
<form action="{{ route('trainers.update', $trainer) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('trainers._form')
</form>
@endsection