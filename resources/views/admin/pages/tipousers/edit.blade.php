@extends('adminlte::page')

@section('title', "Editar Tipo de Usuário {$tipouser->name}")

@section('content_header')
    <h1>Editar Tipo de Usuário <strong>{{ $tipouser->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-body">
            <form action="{{ route('tipousers.update', $tipouser->id)}}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.tipousers._partials.form')
          </form>
        </div>
    </div>
@stop
