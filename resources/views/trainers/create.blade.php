@extends('layouts.app')

@section('content')
<h2>Nuevo trainer</h2>
<form action="{{ route('trainers.store') }}" method="POST">
    @csrf
    @include('trainers._form')
</form>
@endsection