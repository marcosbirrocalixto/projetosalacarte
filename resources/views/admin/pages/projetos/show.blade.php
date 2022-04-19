@extends('adminlte::page')

@section('title', "Detalhe do Projeto {{ $projeto->name }}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projetos.index') }}">Projetos</a></li>
    </ol>
    <h1>Detalhes do Projeto <b>{{ $projeto->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-body">
            <ul>
                <li>
                <img src="{{ url("storage/{$projeto->image}") }}" alt="{{ $projeto->name }}" style="max-width: 90px;">
                </li>
                <li>
                    <strong>Nome: </strong> {{ $projeto->name }}
                </li>
                <li>
                    <strong>Orçamento: </strong> {{ $projeto->orcamento }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $projeto->description }}
                </li>
            </ul>            
            
        <form action="{{ route('projetos.delete', $projeto->url) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o Projeto: {{ $projeto->name }}</button>
        </form>
    </div>
@stop
