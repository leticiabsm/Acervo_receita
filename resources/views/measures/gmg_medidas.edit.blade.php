@extends('layouts.app')

@section('content')
    <h2>Editar Medida: {{ $measure->name }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('measures.update', $measure->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nome da Medida:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $measure->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="abbreviation" class="form-label">Abreviação (Opcional):</label>
            <input type="text" class="form-control" id="abbreviation" name="abbreviation" value="{{ old('abbreviation', $measure->abbreviation) }}">
        </div>
        <button type="submit" class="btn btn-success">Atualizar Medida</button>
        <a href="{{ route('measures.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection