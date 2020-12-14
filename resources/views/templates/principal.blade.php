<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almoxarifado - @yield('title')</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{asset('css/templates/principal.css')}}" rel="stylesheet"/>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="{{asset('js/templates/principal.js')}}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

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

                        @if(!empty(Auth::user()->id))
                        <div class="dropdown">
                            <a id="dropdown_perfil" name="dropdown_perfil" class="dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg style="color: white" width="2.5em" height="2.5em" viewBox="0 0 16 16" class="bi bi-person-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                                    <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                                </svg>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown_perfil">
                                <a class="dropdown-item" href="{{ route('usuario.edit_perfil', ['id' => Auth::user()->id]) }}"> Editar Perfil </a>
                                <a class="dropdown-item" href="{{ route('usuario.edit_senha', ['id' => Auth::user()->id]) }}"> Editar Senha </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); sessionStorage.clear(); document.getElementById('logout-form').submit();"> Sair </a>
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
                    <img src="{{asset('imagens/logo.png')}}" style="width:200px; margin-top:5px; margin-bottom:-5px; margin-left:10px; margin-right:30px;">
                </a>
                @auth
                    @if (Auth::user()->cargo_id == 2)
                        <div id="accordion" class="mt-3">
                            <div>
                                <a type="button" style="color: white; text-decoration: none; display: block" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <div class="menuEffect" id="headingOne" style="padding: 10px">
                                        <h6 class="mb-0">
                                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-file-earmark-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                                <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
                                                <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                            </svg>
                                            Solicitações
                                        </h6>
                                    </div>
                                </a>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div>
                                        <a data-target="#collapseOne" class="menuEffect selectedMenu" class="selectedMenu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('analise.solicitacoes') }}"><li>Analisar</li></a>
                                        <a data-target="#collapseOne" class="menuEffect selectedMenu" class="selectedMenu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('retira.solicitacoes') }}"><li>Retirar</li></a>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a type="button" style="color: white; text-decoration: none; display: block" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    <div class="menuEffect" id="headingTwo" style="padding: 10px">
                                        <h6 class="mb-0">
                                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-box" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                                            </svg>
                                            Gerenciar Estoque
                                        </h6>
                                    </div>
                                </a>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div>
                                        <a data-target="#collapseTwo" class="menuEffect selectedMenu" class="selectedMenu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('movimento.entradaCreate') }}"><li>Nova Entrada</li></a>
                                        <a data-target="#collapseTwo" class="menuEffect selectedMenu" class="selectedMenu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('movimento.saidaCreate') }}"><li>Nova Saída</li></a>
                                        <a data-target="#collapseTwo" class="menuEffect selectedMenu" class="selectedMenu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('movimento.transferenciaCreate') }}"><li>Nova Transferência</li></a>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a type="button" style="color: white; text-decoration: none; display: block" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <div class="menuEffect" id="headingThree" style="padding: 10px">
                                        <h6 class="mb-0">
                                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                            </svg>
                                            Consultar
                                        </h6>
                                    </div>
                                </a>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div>
                                        <a data-target="#collapseThree" class="menuEffect selectedMenu" class="selectedMenu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('material.index') }}"><li>Materiais</li></a>
                                        <a data-target="#collapseThree" class="menuEffect selectedMenu" class="selectedMenu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('deposito.consultarDeposito') }}"><li>Depósitos</li></a>
                                        <a data-target="#collapseThree" class="menuEffect selectedMenu" class="selectedMenu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('solicitacoe.admin') }}"><li>Solicitações</li></a>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a type="button" style="color: white; text-decoration: none; display: block" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    <div class="menuEffect" id="headingFour" style="padding: 10px">
                                        <h6 class="mb-0">
                                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                            </svg>
                                            Cadastrar
                                        </h6>
                                    </div>
                                </a>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                    <div>
                                        <a data-target="#collapseFour" class="menuEffect selectedMenu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('material.create') }}"><li>Material</li></a>
                                        <a data-target="#collapseFour" class="menuEffect selectedMenu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('usuario.create') }}"><li>Usuário</li></a>
                                        <a data-target="#collapseFour" class="menuEffect selectedMenu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('deposito.create') }}"><li>Depósito</li></a>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a type="button" style="color: white; text-decoration: none; display: block" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                    <div class="menuEffect" id="headingFive" style="padding: 10px">
                                        <h6 class="mb-0">
                                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg>
                                            Editar
                                        </h6>
                                    </div>
                                </a>
                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                                    <div>
                                        <a data-target="#collapseFive" class="menuEffect selectedMenu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('usuario.index') }}"><li>Editar Usuário</li></a>
                                        <a data-target="#collapseFive" class="menuEffect selectedMenu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('material.indexEdit') }}"><li>Editar Material</li></a>
                                        <a data-target="#collapseFive" class="menuEffect selectedMenu" style="padding: 10px 10px 10px 35px; color: white; text-decoration: none; display: grid" href="{{ route('deposito.index') }}"><li>Editar Depósito</li></a>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a type="button" class="selectedMenu" style="color: white; text-decoration: none; display: block" href="{{ route('relatorio.materiais') }}">
                                    <div class="menuEffect" id="headingSix" style="padding: 10px">
                                        <h6 class="mb-0">
                                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-archive" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                              </svg>
                                            Relatórios
                                        </h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                @endauth
                @auth
                    @if (Auth::user()->cargo_id == 1)
                        <div style="margin-top: 10px">
                            <a type="button" style="color: white; text-decoration: none; display: block" href="{{ route('solicita.material') }}">
                                <div class="menuEffect" id="solicitaMaterial" style="padding: 10px">
                                    <h6 class="mb-0">
                                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-clipboard-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                            <path fill-rule="evenodd" d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3zm4.354 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                        </svg>
                                        Solicitar Material
                                    </h6>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a type="button" style="color: white; text-decoration: none; display: block" href="{{ route('minhas.solicitacoes') }}">
                                <div class="menuEffect" id="consultaSolicitacao" style="padding: 10px">
                                    <h6 class="mb-0">
                                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                        </svg>
                                        Minhas Solicitações
                                    </h6>
                                </div>
                            </a>
                        </div>
                    @endif
                @endauth
                @guest
                    <div style="margin-top: 10px">
                        <a type="button" style="color: white; text-decoration: none; display: block" href="{{ route('login') }}">
                            <div class="menuEffect" id="consultaSolicitacao" style="padding: 10px">
                                <h6 class="mb-0">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-box-arrow-in-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                        <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                    </svg>
                                    Entrar
                                </h6>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a type="button" style="color: white; text-decoration: none; display: block" href="{{ route('register') }}">
                            <div class="menuEffect" id="consultaSolicitacao" style="padding: 10px">
                                <h6 class="mb-0">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10zM13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                    Cadastrar-se
                                </h6>
                            </div>
                        </a>
                    </div>
                @else
                    <div>
                        <a type="button" style="color: white; text-decoration: none; display: block" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); sessionStorage.clear(); document.getElementById('logout-form').submit();">
                            <div class="menuEffect" id="consultaSolicitacao" style="padding: 10px">
                                <h6 class="mb-0">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-box-arrow-in-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
                                        <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
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
