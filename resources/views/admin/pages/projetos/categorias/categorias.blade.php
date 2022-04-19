@extends('adminlte::page')

@section('title', "Categorias do projeto {$projeto->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projetos.index') }}">Projetos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('projetos.categorias', $projeto->id) }}" class="active">Categorias</a></li>
    </ol>

    <h1>Categorias do projeto <strong>{{ $projeto->name }}</strong></h1>

    <a href="{{ route('projetos.categorias.available', $plan->id)}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Categoria</a>

@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="50">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td>
                                {{ $categoria->name }}
                            </td>
                            <td style="width: 10px;">
                                <a href="{{ route('projetos.categoria.detach', [$projeto->id, $categoria->id]) }}" class="btn btn-danger">DESVINCULAR</a>
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
