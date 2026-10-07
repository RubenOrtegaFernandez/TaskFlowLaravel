@extends('layouts.dashboard')

@section('title', 'Dashboard · TaskFlow')

@section('content')
<div class="container" style="padding: 2rem;">

    <h1>Dashboard POR CAMBIAR</h1>
    <p>Benvingut/da al teu panel de control, <strong>{{ Auth::user()->nom_usu ?? 'Client' }}</strong>.</p>

</div>

@if(session('missatge_benvinguda'))
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Primer inici de sessió',
            text: "{{ session('missatge_benvinguda') }}",
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'D\'acord'
        });
    </script>
@endif


@endsection