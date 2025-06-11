@extends('layouts.app')

@section('title', 'Adicionar Nota')

@section('content')
    <div class="container my-5">
        <h3 style="color: #ffffff;">Adicionar Nota da Receita</h3>
        <div class="card p-5 shadow rounded-4" style="background-color: #ffffff;">
            <div class="d-flex justify-content-center">
                <form action="{{ route('degustacao.search') }}" method="GET" class="d-flex" style="gap: 10px; max-width: 500px; width: 100%;">
                    <input type="text" name="search" class="form-control" placeholder="Pesquisar uma receita específica"
                        value="{{ $search ?? '' }}">
                    <button type="submit" class="btn btn-success shadow-lg">Buscar</button>
                </form>
            </div>
        </div>
    </div>
@endsection