@extends('adminlte::page')

@section('title', 'Tipos de projetos disponíveis para o projeto {$projeto->name}')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projetos.index') }}">PRojetos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projetos.tipoprojetos', $projeto->id) }}">Tipos De Projetos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('projetos.tipoprojetos.available', $projeto->id) }}" class="active">Disponíveis</a></li>
    </ol>

    <h1>Tipos de projetos disponíveis para o projeto <strong>{{ $projeto->name }}</strong></h1>

@stop

@section('content')
    @include('admin.includes.alerts')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('projetos.tipoprojetos.available', $projeto->id) }}" method="POST" class="form form-inline">
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
                    <form action="{{ route('projetos.tipoprojetos.attach', $projeto->id) }}" method="POST">
                        @csrf

                        @foreach ($tipoprojetos as $tipoprojeto)
                            <tr>
                                <td>
                                    <input type="checkbox" name="tipoprojetos[]" value="{{ $tipoprojeto->id }}">
                                </td>
                                <td>
                                    {{ $tipoprojeto->name }}
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
                {!! $tipoprojetos->appends($filters)->links() !!}
            @else
                {!! $tipoprojetos->links() !!}
            @endif
        </div>
    </div>
@stop
