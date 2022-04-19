@extends('adminlte::page')

@section('title', 'Tipo Projetos')

@section('content_header')
    <h1>Tipo Projetos<a href="{{ route('tipoprojetos.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Tipo Projetos</a></h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tipoprojetos.index') }}" class="">Tipo Projetos</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card header">
            <form action="{{ route('tipoprojetos.search')}}" method="POST" class="form form-inline">
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
                        <th style="width: 270px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipoProjetos as $tipoProjeto)
                    <tr>
                        <td>
                            {{ $tipoProjeto->name }}
                        </td>
                        <td>
                            {{ $tipoProjeto->description }}
                        </td>
                        <td style="width: 10px">
                            <a href="{{route('tipoprojetos.edit', $tipoProjeto->url)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('tipoprojetos.show', $tipoProjeto->url)}}" class="btn btn-warning">Ver</a>
                            </td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $tipoProjetos->appends($filters)->links() !!}
            @else
                {!! $tipoProjetos->links() !!}
            @endif

        </div>
    </div>
@stop
