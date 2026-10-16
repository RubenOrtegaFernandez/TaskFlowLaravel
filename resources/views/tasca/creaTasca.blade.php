@extends('layouts.dashboard')

@section('header-title', 'AFEGIR TASCA')

@section('content')
<div class="login-wrap">
    @include('components.formulario-crea-tasca')
</div>
@endsection