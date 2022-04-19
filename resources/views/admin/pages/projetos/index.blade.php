@extends('adminlte::page')

@section('title', 'Projetos')

@section('content_header')
    <h1>Projetos  <a href="{{ route('projetos.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Projeto</a></h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('projetos.index') }}" class="">Projetos</a></li>
    </ol>
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
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                         <th style="width: 470px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projetos as $projeto)
                    <tr>
                        <td>
                            <img src="{{ url("storage/{$projeto->image}") }}" alt="{{ $projeto->name }}" style="max-width: 90px;">
                        </td>
                        <td>
                            {{ $projeto->name }}
                        </td>
                        <td>
                            {{ $projeto->description }}
                        </td>
                        <td style="width: 10px">
                            <a href="{{route('projetos.edit', $projeto->url)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('projetos.show', $projeto->url)}}" class="btn btn-warning">Ver</a>
                            <a href="{{ route('projetos.categorias', $projeto->id) }}" class="btn btn-info"><i class="fas fa-address-book"></i>Categorias</a>
                            <a href="{{ route('projetos.tipoprojetos', $projeto->id) }}" class="btn btn-info"><i class="fas fa-address-book"></i>Tipo Proj.</a>
                            <a href="{{ route('details.projeto.index', $projeto->id) }}" class="btn btn-info"><i class="fas fa-address-book"></i>Detalhes</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $projetos->appends($filters)->links() !!}
            @else
                {!! $projetos->links() !!}
            @endif

        </div>
    </div>
@stop
