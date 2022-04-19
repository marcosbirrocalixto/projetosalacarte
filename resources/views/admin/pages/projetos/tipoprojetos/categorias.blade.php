@extends('adminlte::page')

@section('title', "Tipo do projeto {$projeto->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projetos.index') }}">Projetos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('projetos.tipoprojetos', $projeto->id) }}" class="active">Tipos de Projetos</a></li>
    </ol>

    <h1>Tipos do projeto <strong>{{ $projeto->name }}</strong></h1>

    <a href="{{ route('projetos.tipoprojetos.available', $plan->id)}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Tipo Projeto</a>

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
                    @foreach ($tipoprojetos as $tipoprojeto)
                        <tr>
                            <td>
                                {{ $tipoprojeto->name }}
                            </td>
                            <td style="width: 10px;">
                                <a href="{{ route('projetos.tipoprojeto.detach', [$projeto->id, $tipoprojeto->id]) }}" class="btn btn-danger">DESVINCULAR</a>
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
