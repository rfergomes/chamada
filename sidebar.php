<!-- Left Sidebar -->
<div class="left main-sidebar">
    <div class="sidebar-inner leftscroll">
        <div id="sidebar-menu">
            <ul>
                <?php
                if (isset($_SESSION) && $_SESSION['nivel_acesso'] == 1) {
                ?>
                    <li class="submenu">
                        <a href="account.php?page=dashboard"><i class="fa fa-fw fa-tachometer"></i><span>Dashboard</span> </a>
                    </li>
                    <li class="submenu">
                        <a href="account.php?page=chamada"><i class="fa fa-fw fa-bullhorn"></i><span>Chamada</span> </a>
                    </li>
                    <li class="submenu">
                        <a class="pro" href="javascript:void(0);"><i class="fa fa-fw fa-shield"></i><span>Administrador</span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="account.php?page=eventos"><i class="fa fa-fw fa-calendar"></i><span>Eventos</span></a></li>
                            <li><a href="account.php?page=pro-settings"><i class="fa fa-fw fa-cogs"></i>Configurações</a></li>
                            <li><a href="account.php?page=pro-profile"><i class="fa fa-fw fa-user"></i>Meu Perfil</a></li>
                            <li><a href="account.php?page=pro-users"><i class="fa fa-fw fa-users"></i>Usuários</a></li>
                            <li><a href="account.php?page=pro-contact-messages"><i class="fa fa-fw fa-envelope"></i>Correio</a></li>
                        </ul>
                    </li>
                <?php
                } elseif (isset($_SESSION) && $_SESSION['nivel_acesso'] == 2) {
                ?>
                    <li class="submenu">
                        <a href="account.php?page=dashboard"><i class="fa fa-fw fa-tachometer"></i><span>Dashboard</span> </a>
                    </li>
                    <li class="submenu">
                        <a href="account.php?page=chamada"><i class="fa fa-fw fa-bullhorn"></i><span>Chamada</span> </a>
                    </li>
                    <li class="submenu">
                        <a class="bg-secondary" href="javascript:void(0);"><i class="fa fa-fw fa-lock"></i><span>Supervisor</span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="account.php?page=eventos"><i class="fa fa-fw fa-calendar"></i><span>Eventos</span></a></li>
                            <li><a href="account.php?page=pro-profile"><i class="fa fa-fw fa-user"></i>Meu Perfil</a></li>
                            <li><a href="account.php?page=pro-users"><i class="fa fa-fw fa-users"></i>Usuários</a></li>
                        </ul>
                    </li>
                <?php
                } elseif (isset($_SESSION) && $_SESSION['nivel_acesso'] == 3) {
                ?>
                    <li class="submenu">
                        <a href="account.php?page=dashboard"><i class="fa fa-fw fa-tachometer"></i><span>Dashboard</span> </a>
                    </li>
                    <li class="submenu">
                        <a href="account.php?page=chamada"><i class="fa fa-fw fa-bullhorn"></i><span>Chamada</span> </a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="submenu">
                        <a href="account.php?page=dashboard"><i class="fa fa-fw fa-tachometer"></i><span>Dashboard</span> </a>
                    </li>
                <?php
                }
                ?>
                <!-- <li class="submenu">
                    <a href="javascript:void(0);"><i class="fa fa-fw fa-table"></i> <span> Eventos </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="account.php?page=tables-basic">Listar</a></li>
                        <li><a href="account.php?page=tables-datatable">Cadastrar</a></li>
                    </ul>
                </li> -->
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End Sidebar -->