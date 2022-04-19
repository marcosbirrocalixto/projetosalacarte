@extends('adminlte::page')

@section('title', 'Cadastrar Nova Categoria')

@section('content_header')
    <h1>Cadastrar Nova Categoria</h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-body">
            <form action="{{ route('categorias.store')}}" class="form" method="post">
                @include('admin.pages.categorias._partials.form')
            </form>
        </div>
    </div>
@stop
