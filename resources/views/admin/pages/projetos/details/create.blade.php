@extends('adminlte::page')

@section('title', "Adicionar Novo Detalhe ao Plano {$projeto->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projetos.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projetos.show', $projeto->url) }}">{{$projeto->name}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('details.projeto.index', $projeto->id) }}">Detalhes</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.projeto.create', $projeto->id) }}" class="active">Novo Detalhe</a></li>
    </ol>

    <h1>Adicionar Novo Detalhe ao Projeto {{ $projeto->name }} <a href="{{ route('details.projeto.create', $projeto->id)}}"></a>  </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('details.projeto.store', $projeto->id)}}" class="form" method="post" enctype="multipart/form-data">
                @include('admin.pages.projetos.details._partials.form')
            </form>
        </div>
    </div>
@endsection
