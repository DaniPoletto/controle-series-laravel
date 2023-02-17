<html>
    <head>
        <title>Series</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('series.index') }}">Home</a>
        
        @auth
            <a href="{{ route('logout') }}">Sair</a>
        @endauth

        @guest
            <a href="{{ route('login') }}">Entrar</a>
        @endguest
    </nav>

    <div class="container">
        <h1>{{$title}}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{$slot}}
    </div>
</body>
</html>