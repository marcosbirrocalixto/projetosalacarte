@extends('adminlte::page')

@section('title', 'Cadastrar Novo Tipo Projeto')

@section('content_header')
    <h1>Cadastrar Novo Tipo Projeto</h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-body">
            <form action="{{ route('tipoprojetos.store')}}" class="form" method="post">
                @include('admin.pages.tipoprojetos._partials.form')
            </form>
        </div>
    </div>
@stop
