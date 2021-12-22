@php
$sidebarClass = !empty($sidebarTransparent) ? 'sidebar-transparent' : '';
@endphp

    <style>
        .page-sidebar-minified .sidebar-minify-btn i:before {
            content: '\f101' !important;
        }        
    </style>

<div id="sidebar" class="sidebar">
    <div data-scrollbar="true" data-height="100%">
        <ul class="nav">
            <li class="nav-profile" style="background-image: url({{ asset('storage/background_image/'.$config->config['layout']['background_image']) }})">
                <a href="{{ route('dashboard') }}">
                    <div class="image">
                        @if (isset(Auth::user()->imagem))
                        <img src="{{ route('imagem.render', "user/p/". Auth::user()->imagem) }}" alt="{{ Auth::user()->name }}" />                           
                        @else
                        <img src="{{ asset('assets/img/user/user-12.jpg') }}" alt="" />
                        @endif
                    </div>
                    <div class="info">
                        {{ Auth::user()->name }}
                    </div>
                </a>
            </li>
        </ul>

        <ul class="nav">
            <li class="nav-header">Navegação</li>

            @can('Visualizar usuário')
                <li
                    class="has-sub {{ strpos(Route::currentRouteName(), 'usuario.') === 0 || strpos(Route::currentRouteName(), 'roles.') === 0 ? 'active' : '' }}">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="fa fa-lock"></i>
                        <span>Controle de Acesso</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="has-sub {{ strpos(Route::currentRouteName(), 'usuario.') === 0 ? 'active' : '' }}">
                            <a href="{{ route('controle.usuario.index') }}">
                                <i class="fas fa-user"></i>
                                <span>Usuários</span>
                            </a>
                        </li>
                        <li class="has-sub {{ strpos(Route::currentRouteName(), 'roles.') === 0 ? 'active' : '' }}">
                            <a href="{{ route('controle.roles.index') }}">
                                <i class="fas fa-user-friends"></i>
                                <span>Grupo de usuários</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('Alterar config')
                <li class="has-sub {{ strpos(Route::currentRouteName(), 'config.') === 0 ? 'active' : '' }}">
                    <a href="{{ route('controle.config.edit') }}">
                        <i class="fas fa-cog"></i>
                        <span>Configurações</span>
                    </a>
                </li>
            @endcan

            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                        class="fa fa-angle-double-left"></i></a></li>
        </ul>
    </div>
</div>
