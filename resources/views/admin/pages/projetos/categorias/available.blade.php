@extends('adminlte::page')

@section('title', 'Categorias disponíveis para o projeto {$projeto->name}')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projetos.index') }}">PRojetos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projetos.categorias', $projeto->id) }}">Categorias</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('projetos.categorias.available', $projeto->id) }}" class="active">Disponíveis</a></li>
    </ol>

    <h1>Categorias disponíveis para o projeto <strong>{{ $projeto->name }}</strong></h1>

@stop

@section('content')
    @include('admin.includes.alerts')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('projetos.categorias.available', $projeto->id) }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>
        </div>
       
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th>Nome</th>
                        <th width="50px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('projetos.categorias.attach', $projeto->id) }}" method="POST">
                        @csrf

                        @foreach ($categorias as $categoria)
                            <tr>
                                <td>
                                    <input type="checkbox" name="categorias[]" value="{{ $categoria->id }}">
                                </td>
                                <td>
                                    {{ $categoria->name }}
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-success">Vincular</button>
                                </td>
                            </tr>
                        @endforeach
                    </form>
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
