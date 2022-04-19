@extends('adminlte::page')

@section('title', "Permissões Disponíveis do Perfil {$profile->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.index') }}" class="">Perfis</a></li>
    </ol>

    <h1>Permissões disponíveis do Perfil <b>{{$profile->name}}</b></h1>

@stop



@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card header">
            <form action="{{ route('profiles.permissions.available', $profile->id)}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Palavra de pesquisa" class="form-control" value="{{ $filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-primary"><i class="fab fa-searchengin"></i> Pesquisar </button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('profiles.permissions.attach', $profile->id)}}" method="post">
                        @csrf

                        @foreach ($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                            </td>
                            <td>
                                {{ $permission->name }}
                            </td>
                            <td>
                                {{ $permission->description }}
                            </td>
                        </tr>
                        @endforeach

                        <tr>
                            <td colspan="300">
                                <button type="submit" class="btn btn-success">Vincular</button>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $permissions->appends($filters)->links() !!}
            @else
                {!! $permissions->links() !!}
            @endif

        </div>
    </div>
@stop
