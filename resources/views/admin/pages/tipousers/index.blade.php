@extends('adminlte::page')

@section('title', 'Tipos de Usuários')

@section('content_header')
    <h1>Tipos de Usuário  <a href="{{ route('tipousers.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Tipo de Usuário</a></h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tipousers.index') }}" class="">Tipos de Usuários</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card header">
            <form action="{{ route('tipousers.search')}}" method="POST" class="form form-inline">
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
                    @foreach ($tipousers as $tipouser)
                    <tr>
                        <td>
                            {{ $tipouser->name }}
                        </td>
                        <td>
                            {{ $tipouser->description }}
                        </td>
                        <td style="width: 10px">
                            <a href="{{route('tipousers.edit', $tipouser->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('tipousers.show', $tipouser->id)}}" class="btn btn-warning">Ver</a>
                            </td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $tipousers->appends($filters)->links() !!}
            @else
                {!! $tipousers->links() !!}
            @endif

        </div>
    </div>
@stop
