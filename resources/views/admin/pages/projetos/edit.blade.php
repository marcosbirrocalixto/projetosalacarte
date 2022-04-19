@extends('adminlte::page')

@section('title', "Editar Projeto {$projeto->name}")

@section('content_header')
    <h1>Editar Projeto <strong>{{ $projeto->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('projetos.update', $projeto->url)}}" class="form" method="post" enctype="multipart/form-data">
                @method('PUT')

                @include('admin.pages.projetos._partials.form')
          </form>
        </div>
    </div>
@stop
