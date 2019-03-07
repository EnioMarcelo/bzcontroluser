<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--


/*
  Created on : 05/06/2017, 14:25:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


-->

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title><?= ___BZ_TITULO_SISTEMA___; ?> | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <!-- Theme style iCheck-->
        <link href="<?= base_url('assets'); ?>/plugins/iCheck/all.css<?= '?' . date('YmdHis'); ?>" rel="stylesheet" type="text/css" />
        <!-- Toaster CSS -->
        <link href="<?= base_url('assets'); ?>/css/jquery.toast.css<?= '?' . date('YmdHis'); ?>" rel="stylesheet" type="text/css"/>
        <!-- Stick de Mensagens - NOTIFIT -->
        <link href="<?= base_url('assets'); ?>/css/notifIt.css<?= '?' . date('YmdHis'); ?>" rel="stylesheet" type="text/css"/>


        <!-- Bootstrap 3.3.4 -->
        <link href="<?= base_url('assets'); ?>/bootstrap/css/bootstrap.min.css<?= '?' . date('YmdHis'); ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?= base_url('assets'); ?>/font/font-awesome.min.css<?= '?' . date('YmdHis'); ?>" rel="stylesheet" type="text/css"/>
        <!-- Ionicons -->
        <link href="<?= base_url('assets'); ?>/dist/css/ionicons.min.css<?= '?' . date('YmdHis'); ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?= base_url('assets'); ?>/dist/css/AdminLTE.BZ.min.css<?= '?' . date('YmdHis'); ?>" rel="stylesheet" type="text/css"/>
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link href="<?= base_url('assets'); ?>/dist/css/skins/_all-skins.min.css<?= '?' . date('YmdHis'); ?>" rel="stylesheet" type="text/css"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="<?= base_url('assets'); ?>/dist/js/html5shiv.min.js"></script>
        <script src="<?= base_url('assets'); ?>/dist/js/respond.min.js"></script>
        <![endif]-->

        <!-- CUSTOM MASTERPAGE -->
        <link href="<?= base_url('assets'); ?>/css/custom-masterPage.css<?= '?' . date('YmdHis'); ?>" rel="stylesheet" type="text/css" />

        <!-- BOOT BUZA -->
        <link href="<?= base_url('assets'); ?>/css/boot-buza.css<?= '?' . date('YmdHis'); ?>" rel="stylesheet" type="text/css" />


        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.1.4 -->
        <script src="<?= base_url('assets'); ?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?= base_url('assets'); ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- slimScroll -->
        <script src="<?= base_url('assets'); ?>/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- iCheck 1.0.1 -->
        <script src="<?= base_url('assets'); ?>/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?= base_url('assets'); ?>/dist/js/app.min.js" type="text/javascript"></script>
        <!-- Toaster JS -->
        <script src="<?= base_url('assets'); ?>/js/jquery.toast.js" type="text/javascript"></script>
        <!-- SweetAlert JS -->
        <script src="<?= base_url('assets'); ?>/js/jquery.sweetalert.min.js" type="text/javascript"></script>
        <!-- Stick de Mensagens - NOTIFIT -->
        <script src="<?= base_url('assets'); ?>/js/notifIt.js" type="text/javascript"></script>
        <!-- NOTIFIT MENSAGENS-->
        <script src="<?= base_url('assets'); ?>/js/notifit-mensagens.js" type="text/javascript"></script>
        <!--COMMON JS-->
        <script src="<?= base_url('assets'); ?>/js/common-js.js" type="text/javascript"></script>

        <!-- ROTINAS JQUERY/JAVASCRIPT -->
        <?php $this->load->view('js/common-js-MasterPage'); ?>
        <!-- END ROTINAS JQUERY/JAVASCRIPT -->

    </head>
    <!--
    BODY TAG OPTIONS:
    =================
    Apply one or more of the following classes to get the
    desired effect
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-black                              |
    |               | skin-purple                             |
    |               | skin-yellow                             |
    |               | skin-red                                |
    |               | skin-green                              |
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
    -->

    <?php
    /*
     * CARREGA OS MENUS DO SISTEMA
     */
    $_menus = $_menu_usuario;
    $_menu = '';

    if ($_menus):
        foreach ($_menus as $keyRowMenus => $row_menus):

            $_icon_menu_pai = '';

            $_menu .= '<li class="treeview" style="display: block;">';
            $_menu .= ' <a href="#"><i class=\'fa fa-caret-right\'></i> <span>' . $keyRowMenus . '</span> <i class="fa fa-angle-left pull-right"></i></a>';
            $_menu .= ' <ul class="treeview-menu">';

            foreach ($row_menus as $row_menu_filho):
                $_icon_menu_pai = $this->read->ExecRead('sec_menus', 'WHERE id = ' . $row_menu_filho['id_menu_pai'] . ' AND ativo = "Y" ORDER BY nome_menu')->row('menu_icon');
                if ($_icon_menu_pai):
                    $_menu = str_replace('fa fa-caret-right', 'fa ' . $_icon_menu_pai, $_menu);
                endif;
                $_menu .= '<li><a href="#' . strtolower($row_menu_filho['app']) . '" style="padding-left:40px;" class="j-btn-linkmenu"><i class=\'fa ' . ($row_menu_filho['icon'] ? $row_menu_filho['icon'] : 'fa-caret-right') . '\'></i>' . $row_menu_filho['nome_menu'] . '</a></li>';
            endforeach;

            $_menu .= '</ul></li>';

        endforeach;
    endif;
    /*
     * END CARREGA OS MENUS DO SISTEMA
     */
    ?>


    <body class="skin-<?= ___BZ_LAYOUT_SKINCOLOR___; ?> sidebar-mini fixed <?= ((get_setting('sidebar_collapsed') == 'SIM') ? 'sidebar-collapse' : ''); ?> enio">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">

                <!-- Logo -->
                <a href="<?= site_url(); ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><?= ___BZ_NOME_SISTEMA_ABREVIADO___; ?></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><?= ___BZ_NOME_SISTEMA___; ?></span>
                </a>
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->
                            <!--                            <li class="dropdown messages-menu">
                                                                     Menu toggle button 
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        <i class="fa fa-envelope-o"></i>
                                                                        <span class="label label-success">4</span>
                                                                    </a>
                                                                    <ul class="dropdown-menu">
                                                                        <li class="header">You have 4 messages</li>
                                                                        <li>
                                                                             inner menu: contains the messages 
                                                                            <ul class="menu">
                                                                                <li> start message 
                                                                                    <a href="#">
                                                                                        <div class="pull-left">
                                                                                             User Image 
                                                                                            <img src="<?= base_url('assets'); ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                                                                                        </div>
                                                                                         Message title and timestamp 
                                                                                        <h4>
                                                                                            Support Team
                                                                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                                                        </h4>
                                                                                         The message 
                                                                                        <p>Why not buy a new awesome theme?</p>
                                                                                    </a>
                                                                                </li> end message 
                                                                            </ul> /.menu 
                                                                        </li>
                                                                        <li class="footer"><a href="#">See All Messages</a></li>
                                                                    </ul>
                                                                </li>-->
                            <!-- /.messages-menu -->

                            <!-- Notifications Menu -->
                            <!--                            <li class="dropdown notifications-menu">
                                                             Menu toggle button
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="fa fa-bell-o"></i>
                                                                <span class="label label-warning">10</span>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li class="header">You have 10 notifications</li>
                                                                <li>
                                                                     Inner Menu: contains the notifications
                                                                    <ul class="menu">
                                                                        <li> start notification
                                                                            <a href="#">
                                                                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                                                            </a>
                                                                        </li> end notification
                                                                    </ul>
                                                                </li>
                                                                <li class="footer"><a href="#">View all</a></li>
                                                            </ul>
                                                        </li>-->
                            <!-- Tasks Menu -->
                            <!--                            <li class="dropdown tasks-menu">
                                                             Menu Toggle Button
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="fa fa-flag-o"></i>
                                                                <span class="label label-danger">9</span>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li class="header">You have 9 tasks</li>
                                                                <li>
                                                                     Inner menu: contains the tasks
                                                                    <ul class="menu">
                                                                        <li> Task item
                                                                            <a href="#">
                                                                                 Task title and progress text
                                                                                <h3>
                                                                                    Design some buttons
                                                                                    <small class="pull-right">20%</small>
                                                                                </h3>
                                                                                 The progress bar
                                                                                <div class="progress xs">
                                                                                     Change the css width attribute to simulate progress
                                                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                                                        <span class="sr-only">20% Complete</span>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </li> end task item
                                                                    </ul>
                                                                </li>
                                                                <li class="footer">
                                                                    <a href="#">View all tasks</a>
                                                                </li>
                                                            </ul>
                                                        </li>-->
                            <!-- User Account Menu -->
                            <!--                            <li class="dropdown user user-menu">
                                                                     Menu Toggle Button 
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                         The user image in the navbar
                                                                        <img src="<?= base_url('assets'); ?>/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                                                                         hidden-xs hides the username on small devices so only the image appears. 
                                                                        <span class="hidden-xs">Alexander Pierce</span>
                                                                    </a>
                                                                    <ul class="dropdown-menu">
                                                                         The user image in the menu 
                                                                        <li class="user-header">
                                                                            <img src="<?= base_url('assets'); ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                                                                            <p>
                                                                                Alexander Pierce - Web Developer
                                                                                <small>Member since Nov. 2012</small>
                                                                            </p>
                                                                        </li>
                                                                         Menu Body 
                                                                        <li class="user-body">
                                                                            <div class="col-xs-4 text-center">
                                                                                <a href="#">Followers</a>
                                                                            </div>
                                                                            <div class="col-xs-4 text-center">
                                                                                <a href="#">Sales</a>
                                                                            </div>
                                                                            <div class="col-xs-4 text-center">
                                                                                <a href="#">Friends</a>
                                                                            </div>
                                                                        </li>
                                                                         Menu Footer
                                                                        <li class="user-footer">
                                                                            <div class="pull-left">
                                                                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                                                            </div>
                                                                            <div class="pull-right">
                                                                                <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </li>-->
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a href="#userprofile" class="j-btn-linkmenu hidden-sm hidden-md hidden-lg j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Meus Dados"><i class="fa fa-user margin-right-5"></i><span class="hidden-xs">Meus Dados</span></a>
                                <a href="#userprofile" class="j-btn-linkmenu hidden-xs"><i class="fa fa-user margin-right-5"></i><span>Meus Dados</span></a>
                            </li>
                            <li>
                                <a href="#userprofile?task=changepass" class="j-btn-linkmenu hidden-sm hidden-md hidden-lg j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Alterar Senha"><i class="fa fa-key margin-right-5"></i><span class="hidden-xs">Alterar Senha</span></a>
                                <a href="#userprofile?task=changepass" class="j-btn-linkmenu hidden-xs"><i class="fa fa-key margin-right-5"></i><span class="hidden-xs">Alterar Senha</span></a>
                            </li>
                            <li>
                                <a href="<?= site_url('logout'); ?>" class="hidden-sm hidden-md hidden-lg j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Sair"><i class="fa fa-sign-out margin-right-5"></i><span class="hidden-xs">Sair</span></a>
                                <a href="<?= site_url('logout'); ?>" class="hidden-xs btn-show-modal-aguarde j-tooltip"><i class="fa fa-sign-out margin-right-5"></i><span class="hidden-xs">Sair</span></a>
                            </li>
                            <?php if (check_is_user_super_admin()): ?>
                                <li>
                                    <a href="#" data-toggle="control-sidebar" class="j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Configurações"><i class="fa fa-gears"></i></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <!--                            <img src="<?= base_url('assets'); ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />-->
                            <img src="<?= ($this->session->userdata('user_login')['user_sexo'] == 'M') ? base_url('assets') . '/dist/img/avatar5.png' : base_url('assets') . '/dist/img/avatar2.png'; ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?= $this->session->userdata('user_login')['user_nome']; ?></p>
                            <!-- Status -->
                            <a><i class="fa fa-arrow-circle-right text-primary"></i> Último Login:</a><br/>
                            <a class="text-gray"><?= bz_formatData($this->session->userdata('user_login')['user_ultimo_login'], 'd/m/Y H:i:s'); ?></a>
                        </div>
                    </div>

                    <!-- search form (Optional) -->
                    <!--                    <form action="#" method="get" class="sidebar-form">
                                            <div class="input-group">
                                                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                                                <span class="input-group-btn">
                                                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                        </form>-->
                    <!-- /.search form -->

                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu">
                        <?php if (check_system_is_manutencao()): ?>
                            <li class="header text-center bg-orange-active margin-top-15 margin-bottom-10 j-em-manutencao" style="color: black !important">EM MANUTENÇÃO</li>
                        <?php else: ?>
                            <li class="header text-center bg-orange-active margin-top-15 margin-bottom-10 j-em-manutencao hidden" style="color: black !important">EM MANUTENÇÃO</li>
                        <?php endif; ?>

                        <li class="header text-center margin-top-10">MENU</li>
                        <!-- Optionally, you can add icons to the links -->
                        <li class="active btn-show-modal-aguarde"><a href="<?= site_url('dashboard'); ?>"><i class='fa fa-dashboard'></i> <span>Dashboard</span></a></li>
                        <!--                        <li><a href="#"><i class='fa fa-link'></i> <span>Another Link</span></a></li>-->


                        <?= $_menu ?>


                        <?php if (check_is_user_super_admin()): ?>
                            <li class="treeview" style="display: block;">
                                <a href="#"><i class='fa fa-server'></i> <span>Administração</span> <i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">


                                    <li><a href="#usuarios" style="padding-left:40px;" class="j-btn-linkmenu">Usuários</a></li>
                                    <li><a href="#grupos" style="padding-left:40px;" class="j-btn-linkmenu">Grupos</a></li>
                                    <li><a href="#apps" style="padding-left:40px;" class="j-btn-linkmenu">Aplicativos</a></li>
                                    <li><a href="#menu" style="padding-left:40px;" class="j-btn-linkmenu">Menus</a></li>
                                    <li><a href="#auditoria" style="padding-left:40px;" class="j-btn-linkmenu margin-left: -20px;'">Auditoria</a></li>

                                            <!--                                    <li class="treeview" style="display: block;"><a href="#"><i class='fa fa-circle-o'></i> <span>Administração</span> <i class="fa fa-angle-left pull-right"></i></a>
                                                                                    <ul class="treeview-menu">


                                                                                        <li><a href="#usuarios" class="j-btn-linkmenu">Usuários</a></li>
                                                                                        <li><a href="#grupos" class="j-btn-linkmenu">Grupos</a></li>
                                                                                        <li><a href="#apps" class="j-btn-linkmenu">Aplicativos</a></li>
                                                                                        <li class="treeview" style="display: block;"><a href="#"><i class='fa fa-circle-o'></i> <span>Administração</span> <i class="fa fa-angle-left pull-right"></i></a>
                                                                                            <ul class="treeview-menu">


                                                                                                <li><a href="#usuarios" class="j-btn-linkmenu">Usuários</a></li>
                                                                                                <li><a href="#grupos" class="j-btn-linkmenu">Grupos</a></li>
                                                                                                <li><a href="#apps" class="j-btn-linkmenu">Aplicativos</a></li>


                                                                                            </ul>
                                                                                        </li>


                                                                                    </ul>
                                                                                </li>-->


                                </ul>

                            </li>
                        <?php endif; ?>

                        <?php if (is_dir(APPPATH . '/modules/projectbuildcrud')): ?>
                            <?php if (check_is_user_super_admin()): ?>
                                <li class="treeview" style="display: block;">
                                    <a href="#"><i class='fa fa-cogs'></i> <span>Build</span> <i class="fa fa-angle-left pull-right"></i></a>
                                    <ul class="treeview-menu">

                                        <li><a href="#projectbuildcrud" style="padding-left:40px;" class="j-btn-linkmenu">CRUD</a></li>
                                        <li><a href="#projectbuildblank" style="padding-left:40px;" class="j-btn-linkmenu">Blank</a></li>
                                        <!--                                    <li><a href="#grupos" style="padding-left:40px;" class="j-btn-linkmenu">Grupos</a></li>
                                                                            <li><a href="#apps" style="padding-left:40px;" class="j-btn-linkmenu">Aplicativos</a></li>
                                                                            <li><a href="#menu" style="padding-left:40px;" class="j-btn-linkmenu">Menus</a></li>
                                                                            <li><a href="#auditoria" style="padding-left:40px;" class="j-btn-linkmenu margin-left: -20px;'">Auditoria</a></li>-->


                                    </ul>

                                </li>
                            <?php endif; ?>
                        <?php endif; ?>


                    </ul><!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <!--                <section class="content-header">
                                    <h1>
                                        Page Header
                                        <small>Optional description</small>
                                    </h1>
                                    <ol class="breadcrumb">
                                        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                                        <li class="active">Here</li>
                                    </ol>
                                </section>-->

                <!-- Main content -->
                <section class="margin-left-5 margin-right-5">

                    <?php echo get_mensagem(); ?>

                    <div class="clearfix"></div>

                    <!-- CONTENT -->

                    <?php
                    if (!empty($_conteudo_masterPage)):
                        $this->load->view($_conteudo_masterPage);
                    endif;
                    ?>


                    <iframe class="iframe-modulos invisible margin-top-0" src="" width="100%"  scrolling="yes" style="border: none; min-height: 100% !important">
                    </iframe>


                    <!-- END CONTENT -->

                    <div class="clearfix"></div>


                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->


            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">
                    <strong>Versão:</strong> 1.0.0
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2017 <a href="mailto:eniomarcelo@gmail.com">Enio Marcelo Buzaneli</a>.</strong> Open Source.
            </footer>

            <!-- Control Sidebar -->

            <?php
            if (check_is_user_super_admin()):
                ?>

                <aside class="control-sidebar control-sidebar-dark">
                    <!-- Create the tabs -->
                    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

                        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                        
                        <li><a href="#control-sidebar-other-config-tab" data-toggle="tab"><i class="fa fa-sliders"></i></a></li>

                    </ul>


                    <!-- Tab panes -->
                    <div class="tab-content">

                        <!--                        <h3 class="control-sidebar-heading text-center">Configurações Gerais</h3>-->


                        <!-- Home tab content -->
                        <div class="tab-pane active" id="control-sidebar-home-tab">

                            <h4 class='control-sidebar-heading'>
                                Skins
                            </h4>

                            <form id="form-settings" name="form-settings" method="post">
                                <?php echo settingsConfig('skins'); ?>
                            </form>


                        </div><!-- /.tab-pane -->
                        <!-- Stats tab content -->



                        <!-- Settings tab content -->
                        <div class="tab-pane" id="control-sidebar-settings-tab">

                            <h4 class='control-sidebar-heading'>
                                Configurações Gerais
                            </h4>

                            <form id="form-settings" name="form-settings" method="post">
                                <?php echo settingsConfig('gerais'); ?>
                            </form>

                        </div><!-- /.tab-pane -->


                        <!-- Settings tab content -->
                        <div class="tab-pane" id="control-sidebar-other-config-tab">

                            <h4 class='control-sidebar-heading'>
                                Outras Configurações
                            </h4>

                            <form id="form-settings" name="form-settings" method="post">
                                <?php echo settingsConfig('other-config'); ?>
                            </form>

                        </div><!-- /.tab-pane -->



                    </div>

                    <form id="form-settings" name="form-settings" method="post">
                        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                            <li><a href="#" data-toggle="control-sidebar" class="btn-show-modal-aguarde btn-salvar-formsettings"><i class="fa fa-save">&nbsp;&nbsp;</i>Salva Configurações</a></li>
                        </ul>
                    </form>

                    <div class="margin-top-30 text-center">

                        CI Versão : <?= CI_VERSION; ?>

                    </div>
                </aside><!-- /.control-sidebar -->


            <?php endif; ?>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class='control-sidebar-bg'></div>
        </div><!-- ./wrapper -->


    </body>
</html>


<!-- MODAL AGUARDE -->
<div id="modal-aguarde" class="bz-aguarde-modal">
    <div class="bz-aguarde-modal-dialog">
        <div class="bz-aguarde-modal-content">

            <div class="bz-aguarde-modal-body">
                <p class="text-center">Aguarde</p>
                <p class="text-center"><img src="<?= base_url('assets'); ?>/img/Facebook.gif" width="50px" style="margin-top: -20px;"></p>
            </div>

        </div><!-- /.bz-aguarde-modal-content -->
    </div><!-- /.bz-aguarde-modal-dialog -->
</div><!-- /.bz-aguarde-modal -->
<!-- END MODAL AGUARDE -->


<!-- MODAL FULL SCREEN -->
<div class="modal modal-fullscreen footer-to-bottom" id="bzModalFullscreen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog animated zoomInLeft">
        <div class="modal-content">
            <!--            <div class="modal-header">
                            <button type="button" style="" class="close padding-right-20 padding-left-20 j-tooltip" data-original-title='Sair Tela Cheia' data-placement='bottom' data-toggle='tooltip' data-dismiss="modal" aria-hidden="true">×</button>
                        </div>-->
            <div class="modal-body">
                <iframe class="iframe-modulos margin-top-0" src="<?= site_url($this->router->fetch_class()); ?>" width="100%"  scrolling="yes" style="border: none; min-height: 100% !important">
                </iframe>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END MODAL FULL SCREEN -->

