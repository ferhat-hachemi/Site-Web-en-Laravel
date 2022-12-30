@extends('modele')

@section('title','Copier les associations')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/association_form.css') }}">

    <h3>Copie des associations</h3>
    <form method="post">
        @csrf
        <select name="id">
            @foreach($cours as $c)
                <option value ="{{$c->id}}">{{$c->intitule}}</option>
            @endforeach
        </select><br>
        <br>
        <input type="submit" value="Coller">
    </form>

@endsection
