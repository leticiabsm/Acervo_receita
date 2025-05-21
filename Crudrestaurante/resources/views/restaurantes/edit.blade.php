@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Restaurante</h2>
    <form action="{{ route('restaurantes.update', $restaurante->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nome:</label>
            <input type="text" name="nome" value="{{ $restaurante->nome }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Contato:</label>
            <input type="text" name="contato" value="{{ $restaurante->contato }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Telefone:</label>
            <input type="text" name="telefone" value="{{ $restaurante->telefone }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('restaurantes.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
