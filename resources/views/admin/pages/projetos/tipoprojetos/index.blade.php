@extends('adminlte::page')

@section('title', "Tipo do Projeto {$projeto->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tipoprojetos.index') }}">Tipo do Projet</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('projetos.tipoprojetos', $projeto->id) }}" class="active">Projetos</a></li>
    </ol>

    <h1>Tipos do Projeto <b>{{$projeto->name}}</b></h1>

    <a href="{{ route('projetos.tipoprojetos.available', $projeto->id)}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Tipo Projeto</a>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card header">
            <form action="{{ route('projetos.search')}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Palavra de pesquisa" class="form-control" value="{{ $filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-primary"><i class="fab fa-searchengin"></i> Pesquisar </button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th style="width: 50px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipoprojetos as $tipoprojeto)
                    <tr>
                        <td>
                            {{ $tipoprojeto->name }}
                        </td>
                        <td>
                            {{ $tipoprojeto->description }}
                        </td>
                        <td style="width: 10px">
                            <a href="{{route('projetos.tipoprojeto.detach', [$projeto->id, $tipoprojeto->id])}}" class="btn btn-warning">Desvinvular</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $tipoprojetos->appends($filters)->links() !!}
            @else
                {!! $tipoprojetos->links() !!}
            @endif

        </div>
    </div>
@stop
