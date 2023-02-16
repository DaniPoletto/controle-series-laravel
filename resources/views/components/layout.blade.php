<html>
    <head>
        <title>Series</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('series.index') }}">Home</a>
        
        <a href="{{ route('logout') }}">Sair</a>
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