<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="images/icono.png" />
    
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-image: url("{{asset('images/suculenta.jpg')}}");
            min-height: 100%;
            background-size: auto;
            background-repeat: no-repeat;
        }

        .navbar-nav {
            margin-left: auto;

        }

    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg " style="background-color: #88bd9e;">
        <div class="container-fluid">
            {{-- <a class="navbar-brand" href="#">Centro Médico Epoje</a> --}}
            <h4 class='font-weight-bold display-6 ms-3'>Centro Médico Epoje</h4>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @if(auth()->check())
                    <p class='me-4 mb-0'>Bienvenido/a <b>{{auth()->user()->nom_usuario}} {{auth()->user()->apep_usuario}} {{auth()->user()->apem_usuario}}</b> </p>
                    <li class="nav-item me-4">
                        <a class=" btn btn-outline-light " aria-current="page" href="{{route('login.destroy')}}">Logout</a>
                    </li>
                    {{-- @else
                        <li class="nav-item me-4">
                        <a class=" btn btn-outline-light " aria-current="page" href="{{route('login.index')}}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="  btn btn-outline-dark " aria-current="page" href="{{route('registro.index')}}">Registro</a>
                    </li> --}}
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('contenido')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
