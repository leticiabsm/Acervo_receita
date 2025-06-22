@extends('layouts.publica')

@section('content')
<div class="mb-3">
  <label for="livro_id" class="form-label">Livro</label>
  <select name="livro_id" class="form-control">
    @foreach($livros as $livro)
      <option value="{{ $livro->idlivro }}" {{ old('livro_id', optional($livroPublicado)->livro_id) == $livro->idlivro ? 'selected' : '' }}>
        {{ $livro->titulo }}
      </option>
    @endforeach
  </select>
</div>

<div class="mb-3">
  <label for="funcionario_id" class="form-label">Cozinheiro</label>
  <select name="funcionario_id" class="form-control">
    @foreach($funcionarios as $func)
      <option value="{{ $func->id }}" {{ old('funcionario_id', optional($livroPublicado)->funcionario_id) == $func->id ? 'selected' : '' }}>
        {{ $func->nome }} ({{ $func->nome_fantasia }})
      </option>
    @endforeach
  </select>
</div>

<div class="mb-3">
  <label for="nota_id" class="form-label">Degustador</label>
  <select name="nota_id" class="form-control">
    @foreach($notas as $nota)
      <option value="{{ $nota->id }}" {{ old('nota_id', optional($livroPublicado)->nota_id) == $nota->id ? 'selected' : '' }}>
        {{ $nota->degustador }}
      </option>
    @endforeach
  </select>
</div>

<div class="mb-3">
  <label for="editor" class="form-label">Editor Responsável</label>
  <input type="text" name="editor" class="form-control" value="{{ old('editor', optional($livroPublicado)->editor) }}">
</div>

<div class="mb-3">
  <label for="isbn" class="form-label">ISBN</label>
  <input type="text" name="isbn" class="form-control" value="{{ old('isbn', optional($livroPublicado)->isbn) }}">
</div>
@endsection