<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almoxarifado - @yield('title')</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</head>
<body style="background-color: #151631">
<div id="app" >
    <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: #3E3767;" >
        <div class="container" >

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>
                <ul class="navbar-nav ml-auto" >
                    <a class="nav-link menuSupEInf" style="color: white; font-weight: bold" href="{{ route('home') }}">
                        <li class="nav-item " style="padding: 0px 15px">
                            {{ __('Inicio') }}
                        </li>
                    </a>
                    <a class="nav-link menuSupEInf" style="color: white; font-weight: bold" href="{{ route('sistema') }}">
                        <li class="nav-item " style="padding: 0px 15px">
                            {{ __('O Sistema') }}
                        </li>
                    </a>
                    <a class="nav-link menuSupEInf" style="color: white; font-weight: bold" href="{{ route('parceria') }}">
                        <li class="nav-item " style="padding: 0px 15px">
                            {{ __('A Parceria') }}
                        </li>
                    </a>
                    <a class="nav-link menuSupEInf" style="color: white; font-weight: bold" href="{{ route('contato') }}">
                        <li class="nav-item " style="padding: 0px 15px">
                            {{ __('Contato') }}
                        </li>
                    </a>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md"  style="background-color: #1b1c42; ">

                @yield('content')

                @yield('post-script')

        </div>
    </div>
</div>

<div id="appRodape" class="navbar-light" style="background-color:#3E3767; padding-bottom:1rem; color:white">
    <div class="container" >
        <div class="row justify-content-center" style="border-bottom: #949494 2px solid; padding: 10px; font-weight: bold">
            <div class="col-sm-3" align="center" >
                <div class="row justify-content-center" style="margin-top:15px;">
                    <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a href="{{ route('home') }}">Início</a> | <a href="{{ route('home') }}">Sobre</a></div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-6" align="center">
                <div class="row justify-content-center" style="margin-top:10px; margin-top:1.4rem;">
                    <div class="col-sm-12" id="" style="font-weight:bold; font-family:arial; color:white">Desenvolvido por</div>
                    <div style="margin:3px;" >
                        <a href="http://lmts.uag.ufrpe.br/" target="blank">
                            <img src="{{ asset('/imagens/logo_lmts.png') }}">
                        </a>
                    </div>
                    <div style="margin:3px;">
                        <a href="http://www.upe.br/garanhuns/" target="blank">
                            <img style="width: 100px" src="{{ asset('/imagens/logo_upe.png') }}">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" align="center">
                <div class="row justify-content-center" style="margin-top:10px; margin-top:1.4rem;">
                    <div class="col-sm-12" id="" style="font-weight:bold; font-family:arial; color:white">Apoio</div>
                    <div style="margin:3px;">
                        <a href="http://www.uag.ufrpe.br/" target="blank">
                            <img src="{{ asset('/imagens/logo_ufape.png') }}">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
