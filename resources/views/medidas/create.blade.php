@extends('layouts.medidas')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h2 class="mb-4 text-center" style="font-weight: bold; color: #333;">Adicionar Nova Medida</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('medidas.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="tipo" class="form-label fw-bold">Tipo (ml, kg, xícara, etc.):</label>
                    <input type="text" id="tipo" name="tipo" class="form-control" value="{{ old('tipo') }}" required>
                    @error('tipo')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="item" class="form-label fw-bold">Item (grande, médio, pequeno, etc.):</label>
                    <input type="text" id="item" name="item" class="form-control" value="{{ old('item') }}" required>
                    @error('item')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="descricao" class="form-label fw-bold">Quantidade/Descrição:</label>
                    <input type="text" id="descricao" name="descricao" class="form-control" value="{{ old('descricao') }}" required>
                    @error('descricao')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">Adicionar Medida</button>
                    <a href="{{ route('medidas.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
