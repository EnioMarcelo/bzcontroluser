<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <!--


    /*
      Created on : 01/08/2017, 15:29:00
      Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
     */


    -->
    <section class="content-header header-dashboard">
        

        <h1>
            <i class="fa fa-dashboard"></i>
            Dashboard
            <small>Painel Principal</small>
        </h1>


        <ol class="breadcrumb">
            <li class=""><a href="<?= site_url('dashboard'); ?>" class="active"><i class="fa fa-dashboard"></i>Dashboard</a>
            </li>
        </ol>


        <?php if (!empty($_app_start)): ?>
            <div class="row margin-top-15 margin-left-0">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <iframe style="width: 100%;height: 76vh;position: relative;"
                            src="<?= site_url() . $_app_start; ?>" frameborder="0" allowfullscreen>
                    </iframe>
                </div>
            </div>
        <?php endif; ?>


    </section>

<?php
//set_mensagem_trigger_notifi('Teste de Mensagem INFO', 'info');
//echo get_mensagem();
//set_mensagem_trigger_notifi('Teste de Mensagem SUCCESS', 'success');
//echo get_mensagem();
//set_mensagem_trigger_notifi('Teste de Mensagem WARNING', 'warning');
//echo get_mensagem();
//set_mensagem_trigger_notifi('Teste de Mensagem ERROR', 'error');
//echo get_mensagem();


//$_posistion = 'br';
////
//set_mensagem_nice('', ___MSG_UPDATE_REGISTRO___, 'info', $_posistion);
//echo get_mensagem();
//set_mensagem_nice('', 'Sucesso', 'success', $_posistion);
//echo get_mensagem();
//set_mensagem_nice('', 'Aviso', 'warning', $_posistion);
//echo get_mensagem();
//set_mensagem_nice('', 'Erro', 'error', $_posistion);
//echo get_mensagem();
