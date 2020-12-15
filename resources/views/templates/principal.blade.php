<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almoxarifado - @yield('title')</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="{{asset('css/templates/principal.css')}}" rel="stylesheet"/>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
            integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
            crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="{{asset('js/templates/principal.js')}}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body style="background-color: #151631">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: #3E3767;">
        <div class="container">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>
                <ul class="navbar-nav ml-auto">
                    <a class="nav-link menuSupEInf" style="color: white; font-weight: bold" href="{{ route('home') }}">
                        <li class="nav-item " style="padding: 0px 15px">
                            {{ __('Inicio') }}
                        </li>
                    </a>
                    <a class="nav-link menuSupEInf" style="color: white; font-weight: bold"
                       href="{{ route('sistema') }}">
                        <li class="nav-item " style="padding: 0px 15px">
                            {{ __('O Sistema') }}
                        </li>
                    </a>
                    <a class="nav-link menuSupEInf" style="color: white; font-weight: bold"
                       href="{{ route('parceria') }}">
                        <li class="nav-item " style="padding: 0px 15px">
                            {{ __('A Parceria') }}
                        </li>
                    </a>
                    <a class="nav-link menuSupEInf" style="color: white; font-weight: bold"
                       href="{{ route('contato') }}">
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
                        <div class="btn-group" onselectstart="return false">
                            <a id="dropdown_notificacao" name="dropdown_perfil" class="nav-link dropdown-toggle" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white" >
                                <li class="nav-item ">
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
                                           href="{{route('notificacao.show', ['notificacao_id' => $notificacao->id])}}">{{$notificacao->mensagem}}</a>
                                    <hr></hr>
                                    @endif

                                @endforeach
                                <a class="dropdown-item" href="{{route('notificacao.index')}}">Ver todas as notificações</a>
                            </div>
                        </div>
                    @endif

                    @if(!empty(Auth::user()->id))
                        <div class="dropdown">
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
                            <div class="dropdown-menu" aria-labelledby="dropdown_perfil">
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
        <div class="col-sm-2" style="background-color: #151631; color: white; height: 550px;">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{asset('imagens/logo.png')}}"
                     style="width:200px; margin-top:5px; margin-bottom:-5px; margin-left:10px; margin-right:30px;">
            </a>
            @auth
                @if (Auth::user()->cargo_id == 1)
                    @include('templates.painel.requerente')
                @endif
            @endauth
            @auth
                @if(Auth::user()->cargo_id == 2)
                    @include('templates.painel.admin')
                @endif
            @endauth
            @auth
                @if (Auth::user()->cargo_id == 3)
                    @include('templates.painel.diretoria')
                @endif
            @endauth
            @guest
                <div style="margin-top: 10px">
                    <a type="button" style="color: white; text-decoration: none; display: block"
                       href="{{ route('login') }}">
                        <div class="menuEffect" id="consultaSolicitacao" style="padding: 10px">
                            <h6 class="mb-0">
                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-box-arrow-in-right"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                    <path fill-rule="evenodd"
                                          d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg>
                                Entrar
                            </h6>
                        </div>
                    </a>
                </div>
                <div>
                    <a type="button" style="color: white; text-decoration: none; display: block"
                       href="{{ route('register') }}">
                        <div class="menuEffect" id="consultaSolicitacao" style="padding: 10px">
                            <h6 class="mb-0">
                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-plus"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10zM13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                                Cadastrar-se
                            </h6>
                        </div>
                    </a>
                </div>
            @else
                <div>
                    <a type="button" style="color: white; text-decoration: none; display: block"
                       href="{{ route('logout') }}"
                       onclick="event.preventDefault(); sessionStorage.clear(); document.getElementById('logout-form').submit();">
                        <div class="menuEffect" id="consultaSolicitacao" style="padding: 10px">
                            <h6 class="mb-0">
                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-box-arrow-in-left"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
                                    <path fill-rule="evenodd"
                                          d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                                </svg>
                                Sair
                            </h6>
                        </div>
                    </a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
        </div>
        <div class="col-10" style="background-color: #1b1c42; ">
            <div class="container" style="background-color: white; margin-top: 30px; padding: 20px;border-radius: 15px">
                @yield('content')

                @yield('post-script')
            </div>
        </div>
    </div>
</div>

<div id="appRodape" class="navbar-light" style="background-color:#3E3767; padding-bottom:1rem; color:white">
    <div class="container">
        <div class="row justify-content-center"
             style="border-bottom: #949494 2px solid; padding: 10px; font-weight: bold">
            <div class="col-sm-3" align="center">
                <div class="row justify-content-center" style="margin-top:15px;">
                    <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a href="{{ route('home') }}">Início</a>
                        | <a href="{{ route('home') }}">Sobre</a></div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-6" align="center">
                <div class="row justify-content-center" style="margin-top:10px; margin-top:1.4rem;">
                    <div class="col-sm-12" id="" style="font-weight:bold; font-family:arial; color:white">Desenvolvido
                        por
                    </div>
                    <div style="margin:3px;">
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