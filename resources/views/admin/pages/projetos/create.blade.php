@extends('adminlte::page')

@section('title', 'Cadastrar Novo Projeto')

@section('content_header')
    <h1>Cadastrar Novo Projeto</h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-body">
            <form action="{{ route('projetos.store')}}" class="form" method="post" enctype="multipart/form-data">
                @include('admin.pages.projetos._partials.form')
            </form>
        </div>
    </div>
@stop
