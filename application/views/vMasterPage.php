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
    <title><?= bz_remove_strip_tags_content($this->config->item('config_system')['CONF_TITULO_SISTEMA']); ?></title>
    <?= $this->config->item('config_system')['CONF_ICON']; ?>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Theme style iCheck-->
    <link href="<?= base_url('assets'); ?>/plugins/iCheck/all.css" rel="stylesheet" type="text/css"/>
    <!-- Toaster CSS -->
    <link href="<?= base_url('assets'); ?>/css/jquery.toast.css" rel="stylesheet" type="text/css"/>
    <!-- Stick de Mensagens - NOTIFIT -->
    <link href="<?= base_url('assets'); ?>/css/notifIt.css" rel="stylesheet" type="text/css"/>
    <!-- Stick de Mensagens - NICE - http://demo.hackandphp.com/jquery-nice-notify-notification-messages/ -->
    <link href="<?= base_url('assets'); ?>/css/jquery.nice.css" rel="stylesheet" type="text/css"/>
    <!-- Stick de Mensagens trigger notify -->
    <link href="<?= base_url('assets'); ?>/css/trigger_notify.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?= base_url('assets'); ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome Icons -->
    <link href="<?= base_url('assets'); ?>/font/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->
    <link href="<?= base_url('assets'); ?>/dist/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="<?= base_url('assets'); ?>/dist/css/AdminLTE.BZ.min.css" rel="stylesheet" type="text/css"/>
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="<?= base_url('assets'); ?>/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="<?= base_url('assets'); ?>/dist/js/html5shiv.min.js"></script>
        <script src="<?= base_url('assets'); ?>/dist/js/respond.min.js"></script>
        <![endif]-->

    <!-- CUSTOM MASTERPAGE -->
    <link href="<?= base_url('assets'); ?>/css/custom-masterPage.css" rel="stylesheet" type="text/css"/>

    <!-- BOOT BUZA -->
    <link href="<?= base_url('assets'); ?>/css/boot-buza.css" rel="stylesheet" type="text/css"/>


    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="<?= base_url('assets'); ?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?= base_url('assets'); ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- slimScroll -->
    <script src="<?= base_url('assets'); ?>/plugins/slimScroll/jquery.slimscroll.min.js"
            type="text/javascript"></script>
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
    <!-- NICE MENSAGENS-->
    <script src="<?= base_url('assets'); ?>/js/jquery.nice.js" type="text/javascript"></script>
    <!-- Stick de Mensagens trigger notify -->
    <script src="<?= base_url('assets'); ?>/js/Jquery.trigger_notify.js" type="text/javascript"></script>
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
$_menuBuild = '';

if ($_menus):
    foreach ($_menus as $keyRowMenus => $row_menus):

        $_icon_menu_pai = '';

        $_menuBuild = '';

        $_menuBuild .= '<li class="treeview" style="display: block;">';
        $_menuBuild .= ' <a href="#"><i class=\'fa fa-caret-right\'></i> <span>' . $keyRowMenus . '</span> <i class="fa fa-angle-left pull-right"></i></a>';
        $_menuBuild .= ' <ul class="treeview-menu">';

        $_menuFilho = '';

        foreach ($row_menus as $row_menu_filho):
            $_icon_menu_pai = $this->read->exec('sec_menus', 'WHERE id = ' . $row_menu_filho['id_menu_pai'] . ' AND ativo = "Y" ORDER BY nome_menu')->row('menu_icon');
            if ($_icon_menu_pai):
                $_menuBuild = str_replace('fa fa-caret-right', 'fa ' . $_icon_menu_pai, $_menuBuild);
            endif;
            $_menuFilho .= '   <li><a href="#' . strtolower($row_menu_filho['app']) . '" style="padding-left:40px;" class="j-btn-linkmenu"><i class=\'margin-right-5 fa ' . ($row_menu_filho['icon'] ? $row_menu_filho['icon'] : 'fa-caret-right') . '\'></i>' . $row_menu_filho['nome_menu'] . '</a></li>';

//                $_menuFilho .= '<li class="treeview margin-left-10" style="display: block;">';
//                $_menuFilho .= ' <a href="#"><i class=\'fa ' . ($row_menu_filho['icon'] ? $row_menu_filho['icon'] : 'fa-caret-right') . '\'></i> <span class="margin-0">' . $row_menu_filho['nome_menu'] . '</span> <i class="fa fa-angle-left pull-right"></i></a>';
//                $_menuFilho .= ' <ul class="treeview-menu">';
//                $_menuFilho .= '   <li><a href="#' . strtolower($row_menu_filho['app']) . '" style="padding-left:40px;" class="j-btn-linkmenu"><i class=\'fa fa-search\'></i>' . 'Consulta' . '</a></li>';
//                $_menuFilho .= '   <li><a href="#' . strtolower($row_menu_filho['app'] . '/add') . '" style="padding-left:40px;" class="j-btn-linkmenu"><i class=\'fa fa-plus\'></i>' . 'Novo' . '</a></li>';
//                $_menuFilho .= ' </ul>';
//                $_menuFilho .= '</li>';
        endforeach;

        $_menuBuild .= $_menuFilho;
        $_menuBuild .= '</ul></li>';

        $_menu .= $_menuBuild;

    endforeach;

endif;
/*
 * END CARREGA OS MENUS DO SISTEMA
 */
?>


<body class="skin-<?= ___BZ_LAYOUT_SKINCOLOR___; ?> sidebar-mini fixed <?= ((get_setting('sidebar_collapsed') == 'SIM') ? 'sidebar-collapse' : ''); ?>">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="<?= site_url(); ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><?= $this->config->item('config_system')['CONF_NOME_SISTEMA_ABREVIADO']; ?></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><?= $this->config->item('config_system')['CONF_NOME_SISTEMA']; ?></span>
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
                    <li>
                        <a href="#userprofile" class="j-btn-linkmenu hidden-sm hidden-md hidden-lg j-tooltip"
                           data-placement="bottom" data-toggle="tooltip" data-original-title="Meus Dados"><i
                                    class="fa fa-user margin-right-5"></i><span class="hidden-xs">Meus Dados</span></a>
                        <a href="#userprofile" class="j-btn-linkmenu hidden-xs"><i
                                    class="fa fa-user margin-right-5"></i><span>Meus Dados</span></a>
                    </li>
                    <li>
                        <a href="#userprofile?task=changepass"
                           class="j-btn-linkmenu hidden-sm hidden-md hidden-lg j-tooltip" data-placement="bottom"
                           data-toggle="tooltip" data-original-title="Alterar Senha"><i
                                    class="fa fa-key margin-right-5"></i><span
                                    class="hidden-xs">Alterar Senha</span></a>
                        <a href="#userprofile?task=changepass" class="j-btn-linkmenu hidden-xs"><i
                                    class="fa fa-key margin-right-5"></i><span
                                    class="hidden-xs">Alterar Senha</span></a>
                    </li>
                    <li>
                        <a href="<?= site_url('logout'); ?>" class="hidden-sm hidden-md hidden-lg j-tooltip"
                           data-placement="bottom" data-toggle="tooltip" data-original-title="Sair"><i
                                    class="fa fa-sign-out margin-right-5"></i><span class="hidden-xs">Sair</span></a>
                        <a href="<?= site_url('logout'); ?>" class="hidden-xs btn-show-modal-aguarde j-tooltip"><i
                                    class="fa fa-sign-out margin-right-5"></i><span class="hidden-xs">Sair</span></a>
                    </li>
                    <?php if (check_is_user_super_admin()): ?>
                        <li>
                            <a href="#" data-toggle="control-sidebar" class="j-tooltip" data-placement="bottom"
                               data-toggle="tooltip" data-original-title="Configurações"><i class="fa fa-gears"></i></a>
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
                    <?php if (!empty($this->session->userdata('user_login')['user_gravatar'])): ?>
                        <img src="<?= $this->session->userdata('user_login')['user_gravatar']; ?>" class="img-circle"
                             alt="User Image"/>
                    <?php else: ?>
                        <img src="<?= ($this->session->userdata('user_login')['user_sexo'] == 'M') ? base_url('assets') . '/dist/img/avatar5.png' : base_url('assets') . '/dist/img/avatar2.png'; ?>"
                             class="img-circle" alt="User Image"/>
                    <?php endif; ?>
                </div>
                <div class="pull-left info">
                    <p><?= $this->session->userdata('user_login')['user_nome']; ?></p>
                    <!-- Status -->
                    <a><i class="fa fa-arrow-circle-right text-primary"></i> Último Login:</a><br/>
                    <a class="text-gray"><?= bz_formatdata($this->session->userdata('user_login')['user_ultimo_login'], 'd/m/Y H:i:s'); ?></a>
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
                    <li class="header text-center bg-orange-active margin-top-15 margin-bottom-10 j-em-manutencao"
                        style="color: black !important">EM MANUTENÇÃO
                    </li>
                <?php else: ?>
                    <li class="header text-center bg-orange-active margin-top-15 margin-bottom-10 j-em-manutencao hidden"
                        style="color: black !important">EM MANUTENÇÃO
                    </li>
                <?php endif; ?>

                <li class="header text-center margin-top-10">MENU</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="active btn-show-modal-aguarde"><a href="<?= site_url('dashboard'); ?>"><i
                                class='fa fa-dashboard'></i><span>Dashboard</span></a></li>
                <!--                        <li><a href="#"><i class='fa fa-link'></i> <span>Another Link</span></a></li>-->


                <?= $_menu ?>


                <?php if (check_is_user_super_admin()): ?>
                    <li class="treeview" style="display: block;">
                        <a href="#"><i class='fa fa-server'></i> <span>Administração</span> <i
                                    class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">

                            <li><a href="#usuarios" style="padding-left:40px;" class="j-btn-linkmenu"><i
                                            class='fa fa fa-user margin-right-5'></i>Usuários</a></li>
                            <li><a href="#grupos" style="padding-left:40px;" class="j-btn-linkmenu"><i
                                            class='fa fa fa-group margin-right-5'></i>Grupos</a></li>
                            <li><a href="#apps" style="padding-left:40px;" class="j-btn-linkmenu"><i
                                            class='fa fa fa-code margin-right-5'></i>Aplicativos</a></li>
                            <li><a href="#menu" style="padding-left:40px;" class="j-btn-linkmenu"><i
                                            class='fa fa fa-list margin-right-5'></i>Menus</a></li>
                            <li><a href="#auditoria" style="padding-left:40px;"
                                   class="j-btn-linkmenu margin-left: -20px;'"><i
                                            class='fa fa fa-map-o margin-right-5'></i>Auditoria</a></li>

                        </ul>

                    </li>
                <?php endif; ?>

                <?php if (is_dir(APPPATH . '/modules/projectbuildcrud')): ?>
                    <?php if (check_is_user_super_admin()): ?>
                        <li class="treeview" style="display: block;">
                            <a href="#"><i class='fa fa-cogs'></i> <span>Build</span> <i
                                        class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">

                                <li><a href="#projectbuildcrud" style="padding-left:40px;" class="j-btn-linkmenu"><i
                                                class='fa fa-codepen margin-right-5'></i>Projeto</a></li>

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
        <!--                                <section class="content-header">
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

            <div id="bz-tab-modulos" class="margin-top-5">
                <ul class="nav nav-tabs" id="bzTab" role="tablist"></ul>
                <div class="tab-content" id="bzTabContent"></div>
            </div>

            <!-- END CONTENT -->

            <div class="clearfix"></div>


        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->


    <!-- Main Footer -->
    <footer class="main-footer hidden-xs">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            <strong>Versão:</strong> 1.0.0
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2017/<?=date('Y');?> <a href="mailto:eniomarcelo@gmail.com">Enio Marcelo Buzaneli</a>.</strong> Open
        Source.
    </footer>

    <!-- Control Sidebar -->

    <?php
    if (check_is_user_super_admin()):
        ?>

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a>
                </li>

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
                    <li><a href="#" data-toggle="control-sidebar"
                           class="btn-show-modal-aguarde btn-salvar-formsettings"><i class="fa fa-save">&nbsp;&nbsp;</i>Salva
                            Configurações</a></li>
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
                <p class="text-center"><img src="<?= base_url('assets'); ?>/img/Facebook.gif" width="50px"
                                            style="margin-top: -20px;"></p>
            </div>

        </div><!-- /.bz-aguarde-modal-content -->
    </div><!-- /.bz-aguarde-modal-dialog -->
</div><!-- /.bz-aguarde-modal -->
<!-- END MODAL AGUARDE -->




