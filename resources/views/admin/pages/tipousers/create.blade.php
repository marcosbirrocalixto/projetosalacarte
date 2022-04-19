@extends('adminlte::page')

@section('title', 'Cadastrar Novo Tipo de Usuário')

@section('content_header')
    <h1>Cadastrar Novo Tipo de Usuário</h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-body">
            <form action="{{ route('tipousers.store')}}" class="form" method="post">
                @include('admin.pages.tipousers._partials.form')
            </form>
        </div>
    </div>
@stop
