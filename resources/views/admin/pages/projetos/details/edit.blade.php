@extends('adminlte::page')

@section('title', "Editar Detalhe {$detail->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projetos.index') }}">Projetos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('details.projeto.index', $projeto->id) }}">Detalhes</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.projeto.edit', [$projeto->id, $detail->id]) }}" class="active">Editar</a></li>
    </ol>

    <h1>Editar Detalhe {{ $detail->name }} <a href="{{ route('details.projeto.create', $projeto->id)}}"></a>  </h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-body">
            <form action="{{ route('details.projeto.update', [$projeto->url, $detail->id])}}" class="form" method="post" enctype="multipart/form-data">
                @method('PUT')
                @include('admin.pages.projetos.details._partials.form')
            </form>
        </div>
    </div>
@endsection
