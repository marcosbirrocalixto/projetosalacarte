@extends('adminlte::page')

@section('title', "Editar Plano {$plan->name}")

@section('content_header')
    <h1>Editar Plano <strong>{{ $plan->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.update', $plan->url)}}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.plans._partials.form')
          </form>
        </div>
    </div>
@stop
