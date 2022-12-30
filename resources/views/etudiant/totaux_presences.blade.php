@extends('modele')

@section('title','Liste des etudiants')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/liste.css') }}">
    <caption><?php echo "L`etudiant a un total de $total  presences" ?></>


@endsection
