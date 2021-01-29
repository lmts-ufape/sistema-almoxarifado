<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almoxarifado - @yield('title')</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script defer="defer" src="//barra.brasil.gov.br/barra.js" type="text/javascript"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/templates/principal.js')}}"></script>
</head>
<body style="background-color: #151631">

<div id="barra-brasil" style="background:#7F7F7F; height: 20px; padding:0 0 0 10px;display:block;">
    <ul id="menu-barra-temp" style="list-style:none;">
        <li style="display:inline; float:left;padding-right:10px; margin-right:10px; border-right:1px solid #EDEDED">
            <a href="http://brasil.gov.br" style="font-family:sans,sans-serif; text-decoration:none; color:white;">Portal do Governo Brasileiro</a>
        </li>
        <li>
            <a style="font-family:sans,sans-serif; text-decoration:none; color:white;" href="http://epwg.governoeletronico.gov.br/barra/atualize.html">Atualize sua Barra de Governo</a>
        </li>
    </ul>
</div>

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
                        @Auth
                            <li class="nav-item " style="padding: 0px 15px">
                                {{ __('Início') }}
                            </li>
                        @else
                             <li class="nav-item " style="padding: 0px 15px">
                                {{ __('Entrar') }}
                            </li>
                        @endauth
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
                    @if(!empty(Auth::user()->id) and Auth::user()->cargo_id == 2)
                        @php
                            $notificacoes = Illuminate\Support\Facades\DB::table('notificacaos')->where('usuario_id', '=', Auth::user()->id)->paginate(5);
                            $notNaoVistas = false;
                            for($i=0; $i < count($notificacoes); $i++){
                                if($notificacoes[$i]->visto == false){
                                    $notNaoVistas = true;
                                    break;
                                }
                            }
                        @endphp
                        <div class="dropdown" style="padding-right: 10px" onselectstart="return false">
                            <a id="dropdown_notificacao" name="dropdown_perfil" class="nav-link menuSupEInf"
                               role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
                                <li class="dropdown-toggle nav-item " style="padding: 0px 15px">
                                    @if($notNaoVistas == true)
                                        <b style="color: #ffbe0b">Notificações</b>
                                    @else
                                        <b>Notificações</b>
                                    @endif
                                </li>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown_notificacao">
                                @foreach($notificacoes as $notificacao)
                                    @if($notificacao->visto == false)

                                        <a class="dropdown-item text-danger"
                                           href="{{route('notificacao.show', ['notificacao_id' => $notificacao->id])}}" style="text-align: center">{{$notificacao->mensagem}}</a>
                                        <hr style="margin: 0px; padding: 0px">
                                    @endif

                                @endforeach
                                <a class="dropdown-item" href="{{route('notificacao.index')}}" style="text-align: center">Ver todas as
                                    notificações.</a>
                            </div>
                        </div>
                    @endif

                    @if(!empty(Auth::user()->id))
                        <div class="dropdown" onselectstart="return false">
                            <a id="dropdown_perfil" name="dropdown_perfil" class="dropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg style="color: white" width="2.5em" height="2.5em" viewBox="0 0 16 16"
                                     class="bi bi-person-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                                    <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    <path fill-rule="evenodd"
                                          d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                                </svg>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown_perfil">
                                <a class="dropdown-item"
                                   href="{{ route('usuario.edit_perfil', ['id' => Auth::user()->id]) }}"> Editar
                                    Perfil </a>
                                <a class="dropdown-item"
                                   href="{{ route('usuario.edit_senha', ['id' => Auth::user()->id]) }}"> Editar
                                    Senha </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); sessionStorage.clear(); document.getElementById('logout-form').submit();">
                                    Sair </a>
                            </div>
                        </div>
                    @endif
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
                    <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial">
                        <a href="{{ route('home') }}">Início</a> | 
                        <a href="{{ route('parceria') }}">Sobre</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-6" align="center">
                <div class="row justify-content-center" style="margin-top:10px; margin-top:1.4rem;">
                    <div class="col-sm-12" id="" style="font-weight:bold; font-family:arial; color:white">
                        Desenvolvido por
                    </div>
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
                    <div class="col-sm-12" id="" style="font-weight:bold; font-family:arial; color:white">
                        Apoio
                    </div>
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
