@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Editar Cargo</h2>
    <form action="{{ route('cargos.update', $cargo->idCargo) }}" method="POST">
        @csrf @method('PUT')
        @include('cargos.form')
        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="{{ route('cargos.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
