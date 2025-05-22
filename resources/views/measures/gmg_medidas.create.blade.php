@extends('layouts.app')

@section('content')
    <h2>Adicionar Nova Medida</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('measures.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome da Medida:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="abbreviation" class="form-label">Abreviação (Opcional):</label>
            <input type="text" class="form-control" id="abbreviation" name="abbreviation" value="{{ old('abbreviation') }}">
        </div>
        <button type="submit" class="btn btn-success">Salvar Medida</button>
        <a href="{{ route('measures.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection