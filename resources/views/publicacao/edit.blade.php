@extends('layouts.publica')

@section('content')
<div class="container">
  <h2>Editar Livro Publicado</h2>
  <a href="{{ route('publicacao.edit', $livro->id) }}" class="btn btn-sm btn-primary">
  <i class="bi bi-pencil"></i> Editar
</a>
</div>
@endsection
