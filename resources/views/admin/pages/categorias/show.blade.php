@extends('adminlte::page')

@section('title', "Detalhe da Categoria {{ $categoria->name }}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categorias.index') }}">Categorias</a></li>
    </ol>
    <h1>Detalhes da Categoria <b>{{ $categoria->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $categoria->name }}
                </li>
                <li>
                    <strong>URL: </strong> {{ $categoria->url }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $categoria->description }}
                </li>
            </ul>            
            
        <form action="{{ route('categorias.delete', $categoria->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar a categoria: {{ $categoria->name }}</button>
        </form>
    </div>
@stop
