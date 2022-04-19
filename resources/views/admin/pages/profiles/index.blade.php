@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.index') }}" class="">Perfis</a></li>
    </ol>

    <h1>Perfis  <a href="{{ route('profiles.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Perfil</a></h1>

@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card header">
            <form action="{{ route('profiles.search')}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Palavra de pesquisa" class="form-control" value="{{ $filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-primary"><i class="fab fa-searchengin"></i> Pesquisar </button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th style="width: 250px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($profiles as $profile)
                    <tr>
                        <td>
                            {{ $profile->name }}
                        </td>
                        <td>
                            {{ $profile->description }}
                        </td>
                        <td style="width: 10px">
                            <a href="{{route('profiles.edit', $profile->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('profiles.show', $profile->id)}}" class="btn btn-warning">Ver</a>
                            <a href="{{route('profiles.permissions', $profile->id)}}" class="btn btn-warning"><i class="fas fa-key"></i></a>
                            <a href="{{ route('profiles.plans', $profile->id) }}" class="btn btn-info"><i class="fas fa-list-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $profiles->appends($filters)->links() !!}
            @else
                {!! $profiles->links() !!}
            @endif

        </div>
    </div>
@stop
