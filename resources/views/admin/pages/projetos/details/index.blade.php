@extends('adminlte::page')

@section('title', "Detalhes do Projeto {$projeto->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projetos.index') }}">Projetos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projetos.show', $projeto->url) }}">{{$projeto->name}}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.projeto.index', $projeto->id) }}" class="active">Detalhes</a></li>
    </ol>

    <h1>Adicionar Detalhes ao Projeto {{ $projeto->name }}  <a href="{{ route('details.projeto.create', $projeto->id) }}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Detalhe ao Projeto</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th style="width: 150px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                    <tr>
                        <td>
                            {{ $detail->name }}
                        </td>
                        <td>
                            {{ $detail->description }}
                        </td>
                        <td style="width: 100px">                        
                            <a href="{{route('details.projeto.edit', [$projeto->url, $detail->id])}}" class="btn btn-info">Edit</a>
                            <a href="{{route('details.projeto.show', [$projeto->url, $detail->id])}}" class="btn btn-warning">Ver</a>
                        </td>
                    </tr>
                    <thead>
                        <tr>
                            <th>Imagem 1</th>
                            <th>Imagem 2</th>
                            <th>Imagem 3</th>
                            <th>Imagem 4</th>
                            <th>Imagem 5</th>
                            <th>Imagem 6</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <img src="{{ url("storage/projetos/1/{$detail->image1}") }}" alt="{{ $detail->name }}" style="max-width: 90px;">
                            </td>
                            <td>
                                <img src="{{ url("storage/projetos/1/{$detail->image2}") }}" alt="{{ $detail->name }}" style="max-width: 90px;">
                            </td>
                            <td>
                                <img src="{{ url("storage/projetos/1/{$detail->image3}") }}" alt="{{ $detail->name }}" style="max-width: 90px;">
                            </td>
                            <td>
                                <img src="{{ url("storage/projetos/1/{$detail->image4}") }}" alt="{{ $detail->name }}" style="max-width: 90px;">
                            </td>
                            <td>
                                <img src="{{ url("storage/projetos/1/{$detail->image5}") }}" alt="{{ $detail->name }}" style="max-width: 90px;">
                            </td>
                            <td>
                                <img src="{{ url("storage/projetos/1/{$detail->image6}") }}" alt="{{ $detail->name }}" style="max-width: 90px;">
                            </td>
                        </tr>
                    </tbody>
         
  
                    @endforeach
                </tbody>
           </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $details->appends($filters)->links() !!}
            @else
                {!! $details->links() !!}
            @endif

        </div>
    </div>
@stop



