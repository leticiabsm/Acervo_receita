@extends('layouts.restaurantes')

@section('content')
<div class="container">
    <h2>Adicionar Restaurante</h2>
    <form action="{{ route('restaurantes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Contato:</label>
            <input type="text" name="contato" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Telefone:</label>
            <input type="text" name="telefone" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Adicionar</button>
        <a href="{{ route('restaurantes.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
