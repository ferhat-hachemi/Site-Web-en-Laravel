@extends('modele')

@section('title','Association des enseignants aux cours')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/association_form.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a>
    <h3>Association des enseignants aux cours</h3>
    <form  method="post" >
        @csrf
        <select name="user_id[]" multiple>
            @foreach($users as $user)
                <option value ="{{$user->id}}">{{$user->id}} - {{$user->nom}} {{$user->prenom}} </option>
            @endforeach
        </select><br>
        <br>
        <input type="submit" value="Associer">
    </form>

@endsection
