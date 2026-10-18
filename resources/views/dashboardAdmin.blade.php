@extends('layouts.dashboard')

@section('title', 'Admin · TaskFlow')

@section('content')
    @if (session('status'))
        <p class="admin-panel__description">{{ session('status') }}</p>
    @endif

    @include('components.panel-dashboard')
@endsection