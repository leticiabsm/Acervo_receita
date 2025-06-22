@extends('layouts.ingrediente')

@section('title', 'Adicionar Ingrediente')

@section('content')
    <div class="container my-5">
        <div class="text-center mb-4">
            <h2>Adicionar Novo Ingrediente</h2>
        </div>

        <div class="card shadow mx-auto p-4" style="max-width: 600px;">
            <form action="{{ route('ingredientes.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" id="nome" name="nome" class="form-control" value="{{ old('nome') }}" required>
                    @error('nome')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição (Opcional):</label>
                    <textarea id="descricao" name="descricao" class="form-control" rows="4">{{ old('descricao') }}</textarea>
                    @error('descricao')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                    <a href="{{ route('ingredientes.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
