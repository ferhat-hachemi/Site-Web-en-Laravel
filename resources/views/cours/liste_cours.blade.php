@extends('modele')

@section('title','Liste des cours')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/liste_cours.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a><br>
    <br>
    @if(sizeof($cours)==0)
        <h1>Aucun cours !</h1>

    @else
    <form action="{{route('recherchercours')}}" method="get">
        @csrf
        <input style="width:300px;height:25px;" type="text" name="search" placeholder="Rechercher un cours..">
        <input style="color: #fff;background-color: #2A6881;border-color: #2A6881;" type="submit" name="Envoyer" value="Recherche">
    </form>

    <table>

        <h3>Liste des cours</h3>
        <th>Id</th>
        <th>Intitule</th>
        <th>Modification</th>
        <th>Suppression</th>
        <th>Etudiants</th>
        <th>Enseignant</th>
        <th>Liste</th>
        <th>Liste</th>
        <th>Associer plusieurs</th>
        <th>Dissocier plusieurs</th>
        <th>Seances</th>
        @if(Auth::user()->Enseignant() || Auth::user()->isAdmin())
        <th>Pointage</th>
        @endif
        <th>Copie</th>


        @foreach($cours as $cour)
            <tr>
                <td>{{$cour->id}}</td>
                <td>{{$cour->intitule}}</td>
                <td><a href="{{route('modifiercoursform',['id'=>$cour->id])}}">Modifier</a></td>
                <td><a href="{{route('supprimercoursform',['id'=>$cour->id])}}">Supprimer</a></td>
                <td><a href="{{route('associeretudiantscoursform',['id'=>$cour->id])}}">Associer</a>/<a href="{{route('dissocieretudiantform',['id'=>$cour->id])}}">Dissocier</a> </td>
                <td><a href="{{route('associerenseignantform',['id'=>$cour->id])}}">Associer</a>/<a href="{{route('dissocierenseignantform',['id'=>$cour->id])}}">Dissocier</a></td>
                <td><a href="{{route('listeetudiantsassocies',['id'=>$cour->id])}}">Etudiant</a> </td>
                <td><a href="{{route('listeenseignantassocies',['id'=>$cour->id])}}">Enseignant</a></td>
                <td><a href="{{route('associerplusieursetudiantform',['id'=>$cour->id])}}">Etudiant</a>/<a href="{{route('associerplusieursenseignantform',['id'=>$cour->id])}}">Enseignant</a></td>
                <td><a href="{{route('dissocierplusieursetudiantform',['id'=>$cour->id])}}">Etudiant</a>/<a href="{{route('dissocierplusieursenseignantform',['id'=>$cour->id])}}">Enseignant</a></td>
                <td><a href="{{route('creerseancesform',['id'=>$cour->id])}}">Ajouter</a>/<a href="{{route('listeseancescours',['id'=>$cour->id])}}">Liste</a></td>
                @if(Auth::user()->Enseignant() || Auth::user()->isAdmin())
                <td><a href="{{route('pointeretudiantform',['id'=>$cour->id])}}">Etudiant</a>/<a href="{{route('pointerplusieursetudiantsform',['id'=>$cour->id])}}">Plusieurs</a></td>
                @endif
                <td><a href="{{route('copierassociationform',['id'=>$cour->id])}}">Copier</a></td>
            </tr>
        @endforeach

        @endif

    </table>

@endsection
