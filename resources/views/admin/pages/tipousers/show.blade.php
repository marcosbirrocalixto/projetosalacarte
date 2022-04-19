@extends('adminlte::page')

@section('title', "Detalhe do Tipo de Usuário {{ $tipouser->name }}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tipousers.index') }}">Tipos de Usuários</a></li>
    </ol>
    <h1>Detalhes do Tipo de Usuário <b>{{ $tipouser->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $tipouser->name }}
                </li>
                <li>
                    <strong>URL: </strong> {{ $tipouser->url }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $tipouser->description }}
                </li>
            </ul>            
            
        <form action="{{ route('tipousers.delete', $tipouser->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o Tipo de Usuário: {{ $tipouser->name }}</button>
        </form>
    </div>
@stop
