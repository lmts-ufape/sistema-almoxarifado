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
