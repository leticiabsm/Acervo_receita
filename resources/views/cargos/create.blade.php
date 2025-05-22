@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Novo Cargo</h2>
    <form action="{{ route('cargos.store') }}" method="POST">
        @csrf
        @include('cargos.form')
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('cargos.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
