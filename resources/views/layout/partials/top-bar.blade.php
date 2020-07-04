<div class="d-flex align-content-center flex-wrap">
    {{-- Menu icon --}}
    <div class="mr-auto bd-highlight align-self-center">
        <ion-icon name="menu-outline" id="menu-icon"></ion-icon>
    </div>
    {{-- Phone icon --}}
    <div class="bd-highlight pr-5 pt-1 align-self-center">
        <ion-icon name="call-outline" id="procurar-contactos-icon"></ion-icon>
    </div>
    {{-- Notification icon --}}
    <div class="bd-highlight pr-5 pt-1 align-self-center">
        <ion-icon name="notifications-outline" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></ion-icon>
        <div class="dropdown-menu dropdown-menu-right shadow-sm mt-2" aria-labelledby="dropdownMenuButton">
            <div class="dropdown-header">
                Notificações
            </div>
            <div class="dropdown-content">
                <p class="text-center"><img src="{{asset("/media/cat.jpg")}}" width="200px"><br>I'm Back!!</p>
            </div>
        </div>
    </div>
    {{-- User image --}}
    <div>
        <div class="user-info-general" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="bd-highlight pr-2 align-self-center" style="display:inline-block;">
                <div class="user-image">
                    <img src="{{asset("/media/profile-photo.jpg")}}" alt="Imagem de apresentação" width="100%">
                </div>
            </div>
            {{-- User info --}}
            <div class="bd-highlight align-self-center user-info" style="display:inline-block;">
                @if (Auth()->user()->tipo == "admin")
                <p>{{Auth()->user()->admin->nome.' '.Auth()->user()->admin->apelido}}</p>
                @elseif (Auth()->user()->tipo == "agente")
                <p>{{Auth()->user()->agente->nome.' '.Auth()->user()->agente->apelido}}</p>
                @else
                <p>{{Auth()->user()->cliente->nome.' '.Auth()->user()->cliente->apelido}}</p>
                @endif
                <br>
                @if (Auth()->user()->tipo == "admin")
                <p>Administrador</p>
                @elseif (Auth()->user()->tipo == "agente")
                <p>Agente</p>
                @else
                <p>Cliente</p>
                @endif
            </div>
        </div>
        <div class="dropdown-menu shadow-sm mt-2" aria-labelledby="dropdownMenuButton" id="userInfoDropdown">
            <div class="dropdown-header">
                Menu do utilizador
            </div>
            <div class="dropdown-content" style="padding-top:0px; padding-bottom:0px;">
                <a class="dropdown-item" href="{{route("ajuda")}}">Ajuda</a>
                <a class="dropdown-item" href="#">Definições</a>
                <a class="dropdown-item" href="{{route("report")}}">Reportar problema</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" data-toggle="modal" data-target="#modalLogout" style="cursor:pointer;">Terminar sessão</a>
            </div>
        </div>
    </div>
</div>
