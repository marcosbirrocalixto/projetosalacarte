@extends('adminlte::page')

@section('title', "Editar Categoria {$categoria->name}")

@section('content_header')
    <h1>Editar Categoria <strong>{{ $categoria->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-body">
            <form action="{{ route('categorias.update', $categoria->id)}}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.categorias._partials.form')
          </form>
        </div>
    </div>
@stop
