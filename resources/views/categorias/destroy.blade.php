@extends('layouts.categorias')

@section('title', 'Desativar')

@section('content')
<div class="container my-5">
    <div class="text-center mb-4">
        <h2>Desativar Categoria</h2>
    </div>

    <div class="card shadow mx-auto p-4" style="max-width: 500px;">
        <form action="{{ route('categorias.destroy', $categoria->id_cat) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="mb-3">
                <label class="form-label fw-bold">Nome da Categoria</label>
                <input type="text" class="form-control" value="{{ $categoria->nome_cat }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Descrição</label>
                <textarea class="form-control" rows="3" readonly>{{ $categoria->descricao_cat }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Status Atual</label>
                <input type="text" class="form-control"
                       value="{{ $categoria->ind_ativo ? 'ATIVO' : 'INATIVO' }}" readonly>
            </div>

            <!-- Botão que dispara o modal -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal">
                    Desativar
                </button>
            </div>

            <!-- Modal de confirmação -->
            <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmar Desativação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                  </div>
                  <div class="modal-body">
                    Tem certeza que deseja desativar a categoria <strong>{{ $categoria->nome_cat }}</strong>?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Confirmar</button>
                  </div>
                </div>
              </div>
            </div>
        </form>
    </div>
</div>
@endsection
