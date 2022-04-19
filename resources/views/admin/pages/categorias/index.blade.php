@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1>Categorias  <a href="{{ route('categorias.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Categoria</a></h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('categorias.index') }}" class="">Categorias</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card header">
            <form action="{{ route('categorias.search')}}" method="POST" class="form form-inline">
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
                    @foreach ($categorias as $categoria)
                    <tr>
                        <td>
                            {{ $categoria->name }}
                        </td>
                        <td>
                            {{ $categoria->description }}
                        </td>
                        <td style="width: 10px">
                            <a href="{{route('categorias.edit', $categoria->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('categorias.show', $categoria->id)}}" class="btn btn-warning">Ver</a>
                            </td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $categorias->appends($filters)->links() !!}
            @else
                {!! $categorias->links() !!}
            @endif

        </div>
    </div>
@stop
