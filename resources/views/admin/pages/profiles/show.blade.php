@extends('adminlte::page')

@section('title', "Detalhe do Perfil {{ $profile->name }}")

@section('content_header')
    <h1>Detalhes do Perfil <b>{{ $profile->name }}</b></h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $profile->name }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $profile->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

        <form action="{{ route('profiles.delete', $profile->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o Perfil: {{ $profile->name }}</button>
        </form>
    </div>
@stop
