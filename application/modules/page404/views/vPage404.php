<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--


/*
  Created on : 28/06/2017, 13:46:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


-->

<!-- 404 -->
<style>
    .error-template {padding: 40px 15px;text-align: center;}
    .error-actions {margin-top:15px;margin-bottom:15px;}
    .error-actions .btn { margin-right:10px; }
</style>


<div class="row text-center">
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="">
                <img src="<?= base_url(); ?>assets/img/404.png"" alt="404" style="width:100%">
            </div>
        </div>

        <div class="col-md-6">
            <h1>
                Oops!</h1>
            <h2>
                Página Não Encontrada</h2>
            <div class="error-details">
                Desculpe, ocorreu um erro, a página solicitada não foi encontrada!
            </div>
            <div class="error-actions">
                <a href="<?= site_url(); ?>" target="_top" class="btn btn-primary btn-lg"><span class="fa fa-home"></span>
                    Voltar </a>
            </div>

        </div>
    </div>
</div>


<!-- FIM 404 -->
