
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almoxarifado - @yield('title')</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.2/umd/popper.min.js"></script>

</head>
<body>
    <div id="app" >
        <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: #3E3767;" >
            <div class="container" >
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('imagens/logo.png')}}" style="width:145px; margin-top:-5px; margin-bottom:-5px; margin-left:10px; margin-right:30px;">

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto" >
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" style="color: white; font-weight: bold" href="{{ route('home') }}">{{ __('Inicio') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" style="color: white; font-weight: bold" href="">{{ __('Sobre') }}</a>
                        </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2" style="background-color: #151631; color: white; height: 550px;">
                <ul style="margin-top: 15px">
                    {{-- <li><a href="{{ route('home') }}"><b>PÁGINA INICIAL</b></a></li> --}}
                    <li><b>GERENCIAR CADASTROS</b></li>
                    <ul>
                        <li><a href="{{ route('material.create') }}">Cadastrar material</a></li>
                        <li><a href="{{ route('material.indexEdit') }}">Editar material</a></li>

                        <li><a href="{{ route('deposito.create') }}">Cadastrar depósito</a></li>
                        <li><a href="{{ route('deposito.create') }}">Editar depósito</a></li>
                    </ul>

                    <li><b>CONSULTAR</b></li>
                    <ul>
                        <li><a href="{{ route('material.index') }}">Materiais</a></li>
                        <li><a href="{{ route('deposito.index') }}">Depositos</a></li>
                    </ul>

                    <li><b>GERENCIAR MATERIAIS</b></li>
                    <ul>
                        <li><a href="{{ route('movimento.entradaCreate') }}">Nova Entrada</a></li>
                        <li><a href="{{  route('movimento.saidaCreate') }}">Nova Saída</a></li>
                        <li><a href="{{  route('movimento.transferenciaCreate') }}">Nova Transferência</a></li>
                    </ul>
                </ul>
            </div>
            <div class="col-10"  style="background-color: #1b1c42; ">
                <div class="container" style="background-color: white; margin-top: 30px; padding: 20px;border-radius: 15px">
                    @yield('content')

                    @yield('post-script')
                </div>
            </div>

        </div>

    </div>

    <div id="appRodape" class="fixed-bottom navbar-light" style="background-color:#3E3767; padding-bottom:1rem; color:white">
        <div class="container" >
            <div class="row justify-content-center" style="border-bottom: #949494 2px solid; padding: 10px; font-weight: bold">
                <div class="col-sm-3" align="center" >
                    <div class="row justify-content-center" style="margin-top:15px;">
                          <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Início</a> | <a >Sobre</a></div>
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

