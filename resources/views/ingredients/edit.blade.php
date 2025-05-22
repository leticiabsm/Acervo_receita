@extends('layouts.app')

@section('content')
    <h2>Editar Ingrediente: {{ $ingredient->name }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ingredients.update', $ingredient->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Necessário para o método UPDATE --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nome do Ingrediente:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $ingredient->name) }}" required>
        </div>
        <button type="submit" class="btn btn-success">Atualizar Ingrediente</button>
        <a href="{{ route('ingredients.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection