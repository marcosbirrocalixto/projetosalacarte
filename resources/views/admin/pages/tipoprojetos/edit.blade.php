@extends('adminlte::page')

@section('title', "Editar Tipo Projeto {$tipoProjeto->name}")

@section('content_header')
    <h1>Editar Tipo Projeto <strong>{{ $tipoProjeto->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-body">
            <form action="{{ route('tipoprojetos.update', $tipoProjeto->url)}}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.tipoprojetos._partials.form')
          </form>
        </div>
    </div>
@stop
