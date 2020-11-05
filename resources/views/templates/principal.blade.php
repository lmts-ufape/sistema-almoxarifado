
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almoxarifado - @yield('title')</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    {{-- COM ESSE SCRIPT ABAIXO, A REQUISIÇÂO AJAX NÂO ESTÁ FUNCIONANDO --}}
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
          $(".menu").hover(function(){
            $(this).css("background-color", "#9561e2");
            }, function(){
            $(this).css("background-color", " #151631");
          });
        });
    </script>

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
                <div id="accordion" class="mt-3">
                    <div>
                        <a type="button" style="color: white; text-decoration: none; display: block" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <div class="menu" id="headingOne" style="padding: 10px">
                                <h6 class="mb-0">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                    Cadastrar
                                </h6>
                            </div>
                        </a>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div>
                                <a class="menu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('material.create') }}"><li>Material</li></a>
                                <a class="menu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('usuario.create') }}"><li>Usuário</li></a>
                                <a class="menu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('deposito.create') }}"><li>Depósito</li></a>
                                <a class="menu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('cargo.create') }}"><li>Cargo</li></a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <a type="button" style="color: white; text-decoration: none; display: block" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <div class="menu" id="headingTwo" style="padding: 10px">
                                <h6 class="mb-0">
                                      <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                      </svg>
                                      Editar
                                </h6>
                            </div>
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                          <div>
                          <a class="menu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('usuario.index') }}"><li>Editar Usuario</li></a>
                            <a class="menu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('material.indexEdit') }}"><li>Editar material</li></a>
                            <a class="menu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('deposito.index') }}"><li>Editar depósito</li></a>
                            <a class="menu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('cargo.index') }}"><li>Editar cargo</li></a>
                          </div>
                        </div>
                    </div>
                    <div>
                        <a type="button" style="color: white; text-decoration: none; display: block" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            <div class="menu" id="headingThree" style="padding: 10px">
                                <h6 class="mb-0">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-box" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                                    </svg>
                                    Gerenciar materias
                                </h6>
                            </div>
                        </a>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div>
                                <a class="menu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('movimento.entradaCreate') }}"><li>Nova Entrada</li></a>
                                <a class="menu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('movimento.saidaCreate') }}"><li>Nova Saída</li></a>
                                <a class="menu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('movimento.transferenciaCreate') }}"><li>Nova Transferência</li></a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <a type="button" style="color: white; text-decoration: none; display: block" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            <div class="menu" id="headingFour" style="padding: 10px">
                                <h6 class="mb-0">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                    </svg>
                                    Consultar
                                </h6>
                            </div>
                        </a>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                            <div>
                                <a class="menu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('material.index') }}"><li>Materiais</li></a>
                                <a class="menu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('deposito.consultarDeposito') }}"><li>Depositos</li></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10"  style="background-color: #1b1c42; ">
                <div class="container" style="background-color: white; margin-top: 30px; padding: 20px;border-radius: 15px">
                    @yield('content')

                    @yield('post-script')
                </div>
            </div>
        </div>
    </div>

    <div id="appRodape" class="navbar-light" style="background-color:#3E3767; padding-bottom:1rem; color:white">
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

