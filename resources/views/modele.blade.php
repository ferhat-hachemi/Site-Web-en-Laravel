<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title','universite')</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/app.css') }}">
</head>
<body>
@section('contenu')
    @guest()
        <h1>Bienvenue sur votre site universitaire</h1>
        <div class="menu">
            <ul>
                <li>
                    <a href="{{route('loginform')}}">Connexion</a>
                </li>
                <li>
                    <a href="{{route('registerform')}}">Inscription</a>
                </li>
            </ul>
        </div>

    @endguest
    @auth()
        @if(Auth::user()->isAdmin())
            <div class="menu">
                <ul>
                    <li style="background-color:#34495E;cursor: auto;">
                        <a>Vous etes {{ Auth::user()->login}}</a>
                    </li>
                    <li>
                        <a>Utilisateurs</a>
                        <ul>
                            <li><a href="{{route('listetousutilisateurs')}}">Liste </a></li>
                            <li><a href="{{route('listeUtilisateursattente')}}">Liste d'attente</a></li>
                            <li><a href="{{route('creerutilisateursform')}}">Nouveau utilisateurs</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>Cours</a>
                        <ul>
                            <li><a href="{{route('listecours')}}">Liste</a></li>
                            <li><a href="{{route('creercoursform')}}">Nouveau cours</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>Etudiants</a>
                        <ul>
                            <li><a href="{{route('listetudiants')}}">Liste</a></li>
                            <li><a href="{{route('creeretudiantsform')}}">Nouveau etudiants</a></li>

                        </ul>
                    </li>
                    <li>
                        <a>Seances</a>
                        <ul>
                            <li><a href="{{route('listeseances')}}">Liste</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>Modifier mon compte</a>
                        <ul>
                            <li><a href="{{route('modifiercompteform',[Auth::user()->id])}}">Nom et prenom</a></li>
                            <li><a href="{{route('modifiermotdepasseform')}}">Mot de passe</a></li>

                        </ul>
                    </li>
                    <li>
                    <a href="{{route('logout')}}">Deconnexion</a></li>
                </ul>
            </div>

        @elseif(Auth::user()->Enseignant())
            <div class="menu">
                <ul>
                    <li style="background-color:#34495E;cursor: auto;">
                        <a>Vous etes {{ Auth::user()->login}}</a>
                    </li>
                    <li>
                        <a>Cours</a>
                        <ul>
                            <li><a href="{{route('listcoursenseignant',[Auth::user()->id])}}">Mes cours</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>Modifier mon compte</a>
                        <ul>
                            <li><a href="{{route('modifiercompteform',[Auth::user()->id])}}">Nom et prenom</a></li>
                            <li><a href="{{route('modifiermotdepasseform')}}">Mot de passe</a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="{{route('logout')}}">Deconnexion</a></li>
                </ul>
            </div>
        @else
            <div class="menu">
                <ul>
                    <li style="background-color:#34495E;cursor: auto;">
                        <a>Vous etes {{ Auth::user()->login}}</a>
                    </li>
                    <li>
                        <a>Cours</a>
                        <ul>
                            <li><a href="{{route('listecours')}}">Liste</a></li>
                            <li><a href="{{route('creercoursform')}}">Nouveau cours</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>Etudiants</a>
                        <ul>
                            <li><a href="{{route('listetudiants')}}">Liste</a></li>
                            <li><a href="{{route('creeretudiantsform')}}">Nouveau etudiants</a></li>

                        </ul>
                    </li>
                    <li>
                        <a>Seances</a>
                        <ul>
                            <li><a href="{{route('listeseances')}}">Liste</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>Modifier mon compte</a>
                        <ul>
                            <li><a href="{{route('modifiercompteform',[Auth::user()->id])}}">Nom et prenom</a></li>
                            <li><a href="{{route('modifiermotdepasseform')}}">Mot de passe</a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="{{route('logout')}}">Deconnexion</a></li>
                </ul>
            </div>
        @endif
    @endauth
@show
@if ($errors->any())
    <div class="error">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="background-color: white;color: darkred;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session()->has('etat'))
    <p class="etat">{{session()->get('etat')}}</p>
@endif
</body>
</html>

