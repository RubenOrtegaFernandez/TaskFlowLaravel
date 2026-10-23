@extends('layouts.dashboard')

@section('title', 'Veure Tasca · TaskFlow')
@section('header-title', 'TASCA')

@section('content')
<div>
    <p>{{ $tasca->nom_tas }}</p>
    <a class="tasca__boto" href="{{ route('tasca.index') }}">Tornar al llistat</a>
</div>
@endsection