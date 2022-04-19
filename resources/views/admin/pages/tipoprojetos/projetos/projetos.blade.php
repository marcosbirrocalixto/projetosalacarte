@extends('adminlte::page')

@section('title', "Projetos do Tipo {$tipoProjeto->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tipoprojetos.index') }}">Tipo Projetos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tipoprojetos.projetos', $tipoprojetos->id) }}" class="active">Projetos</a></li>
    </ol>

    <h1>Projetos do Tipo de Projetos <strong>{{ $tipoprojetos->name }}</strong></h1>

@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="50">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projetos as $projeto)
                        <tr>
                            <td>
                                {{ $projeto->name }}
                            </td>
                            <td style="width: 10px;">
                                <a href="{{ route('projetos.tipoprojetos.detach', [$projetos->id, $tipoprojetos->id]) }}" class="btn btn-danger">DESVINCULAR</a>
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
