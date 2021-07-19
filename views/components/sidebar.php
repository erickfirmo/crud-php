<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <img class="img-80 img-radius" src="https://avatars.githubusercontent.com/u/34639603?v=4" alt="User-Profile-Image">
                <div class="user-details">
                    <span id="more-details">Érick Firmo<!--i class="fa fa-caret-down"></i--></span>
                </div>
            </div>
        </div>
        
        <div class="p-15 p-b-0"></div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?php classActivePath('/', 'active'); ?>">
                <a href="<?php url('/'); ?>" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Home</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Cadastros</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu <?php classActivePath('pessoas', 'pcoded-trigger active', [], 1); ?>">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                    <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Pessoas</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="<?php classActivePath('pessoas', 'active'); ?>">
                        <a href="<?php url('pessoas'); ?>" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Listar Todas</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                    <li class="<?php classActivePath('pessoas/cadastrar', 'active'); ?>">
                        <a href="<?php url('pessoas/cadastrar'); ?>" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Cadastrar</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
    </div>
</nav>
