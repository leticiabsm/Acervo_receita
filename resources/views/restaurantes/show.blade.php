@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalhes do Restaurante</h2>
    <p><strong>Nome:</strong> {{ $restaurante->nome }}</p>
    <p><strong>Contato:</strong> {{ $restaurante->contato }}</p>
    <p><strong>Telefone:</strong> {{ $restaurante->telefone }}</p>
    <p><strong>Ativo:</strong> {{ $restaurante->ativo ? 'Sim' : 'Não' }}</p>
    <a href="{{ route('restaurantes.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
