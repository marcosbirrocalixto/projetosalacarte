@extends('adminlte::page')

@section('title', "Detalhe do Tipo Projeto {{ $tipoProjeto->name }}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tipoprojetos.index') }}">Categorias</a></li>
    </ol>
    <h1>Detalhes do Tipo Projeto <b>{{ $tipoProjeto->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $tipoProjeto->name }}
                </li>
                <li>
                    <strong>URL: </strong> {{ $tipoProjeto->url }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $tipoProjeto->description }}
                </li>
            </ul>            
            
        <form action="{{ route('tipoprojetos.delete', $tipoProjeto->url) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o Tipo Projeto: {{ $tipoProjeto->name }}</button>
        </form>
    </div>
@stop
