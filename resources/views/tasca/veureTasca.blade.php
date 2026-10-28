@extends('layouts.dashboard')

@section('title', 'Veure Tasca · TaskFlow')
@section('header-title', 'TASCA')
@section('sense-nav', 'si')

@section('content')
<div class="tasca-detall">
    <div class="tasca-detall__superficie" data-vidre-detall>
    <table class="llistat llistat--detall">
        <caption>Detall de la tasca</caption>
            
        <tbody>
            <tr>
                <th>Nom</th>
                <td>{{ $tasca->nom_tas }}</td>
            </tr>
            <tr>
                <th>Descripció</th>
                <td>{{ $tasca->descripcio }}</td>
            </tr>
            <tr>
                <th>Estat</th>
                <td>{{ str_replace('_', ' ', $tasca->estat) }}</td>
            </tr>
            <tr>
                <th>Prioritat</th>
                <td>{{ $tasca->prioritat }}</td>
            </tr>
            <tr>
                <th>Categoria</th>
                <td>{{ $tasca->categoria }}</td>
            </tr>
            <tr>
                <th>Data d'inici</th>
                <td>{{ $tasca->data_inici?->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <th>Data final</th>
                <td>{{ $tasca->data_final?->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <th>Creador</th>
                <td>{{ $tasca->creador->nom_usu ?? '—' }}</td>
            </tr>
            <tr>
                <th>Departament</th>
                <td>{{ $tasca->departament->nom_dep ?? '—' }}</td>
            </tr>
            <tr>
                <th>Assignada a</th>
                <td>{{ $tasca->assignat->nom_usu ?? 'Sense assignar' }}</td>
            </tr>
        </tbody>
    </table>
    </div>

    <a class="btn tasca__boto" href="{{ route('tasca.index') }}">Tornar al llistat</a>
</div>
@endsection
