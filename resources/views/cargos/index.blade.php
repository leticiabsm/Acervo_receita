@extends('layouts.cargos')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-white" style="font-weight: bold;">Consulta de Cargos</h2>
    
        <div class="d-flex mb-3">
        <form class="flex-grow-1 me-2 d-flex" method="GET" action="{{ route('cargos.index') }}">
            <input type="text" name="searchInput" class="form-control" placeholder="Pesquisar" value="{{ request('searchInput') }}">
            <button type="submit" class="btn" style="background:transparent; border:none; margin-left:-40px;">
                <img src="{{ asset('img/icons/lupa.png') }}" alt="Pesquisar" style="width:22px; height:22px;">
            </button>
        </form>

        <a href="{{ route('cargos.create') }}"
            class="btn d-flex align-items-center"
            style="background:#83CD71; border:3px solid #25BB00; color:#fff; font-weight:bold;">
            Incluir Cargo
            <img src="{{ asset('img/icons/cargo.png') }}" alt="Incluir Cargo" style="width:22px; height:22px;" class="ms-3">
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th class="text-center">Cargo</th>
                    <th class="text-center">Descrição</th>
                    <th class="text-center">Data Início</th>
                    <th class="text-center">Data Fim</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Atividades</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cargos as $cargo)
                <tr>
                    <td class="text-center">{{ $cargo->nome }}</td>
                    <td class="text-center">{{ $cargo->descricao }}</td>
                    <td class="text-center">{{ $cargo->data_inicio ? \Carbon\Carbon::parse($cargo->data_inicio)->format('d/m/Y') : '-' }}</td>
                    <td class="text-center">{{ $cargo->data_finalizacao ? \Carbon\Carbon::parse($cargo->data_finalizacao)->format('d/m/Y') : '-' }}</td>
                    <td class="text-center">
                        @if($cargo->ativo)
                        <span class="text-success fw-bold">ATIVO</span>
                        @else
                        <span class="text-danger fw-bold">INATIVO</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('cargos.edit', $cargo->id) }}" class="btn btn-sm p-1 me-1"
                            style="background:#67C0FF; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; border-radius:6px;"
                            onclick="event.stopPropagation()">
                            <img src="{{ asset('img/icons/la_pen.png') }}" alt="Editar" style="width:18px; height:18px;">
                        </a>

                        <a href="{{ route('cargos.status', $cargo->id) }}" class="btn btn-sm p-1"
                            style="background:#FF7979; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; border-radius:6px;"
                            onclick="event.stopPropagation()">
                            <img src="{{ asset('img/icons/mynaui_trash.png') }}" alt="Status" style="width:18px; height:18px;">
                        </a>


                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection