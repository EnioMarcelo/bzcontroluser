<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/*
  |--------------------------------------------------------------------------
  | CONFIG SYSTEM
  |--------------------------------------------------------------------------
  |
  | Configurações Básicas do Sistema
  |
  |
  |
 */
$_urlBG['login'] = 'assets/img/bg-login.jpg';
$_urlBG['changepass'] = 'assets/img/bg-login.jpg';

$config['CONF_TITULO_SISTEMA'] = 'BUZZAControl';
$config['CONF_NOME_SISTEMA'] = '<b>BUZZA</b>Control';
$config['CONF_NOME_SISTEMA_ABREVIADO'] = '<b>BZ</b>CN';
$config['CONF_ICON'] = '<link rel="icon" href="' . base_url() . 'assets/img/iconbz.png" type="image/png">';

/* LOGIN */
$config['CONF_LOGIN_BG_IMAGE'] = 'style="background: url(' . $_urlBG['login'] . ') no-repeat center center; background-size:cover"';
$config['CONF_LOGIN_LOGO'] = '<div style="color:#000000"><b>Admin</b>' . $config['CONF_TITULO_SISTEMA'] . '</a></div>';
$config['CONF_LOGIN_FOOTER'] = '<div style="text-align: center; margin-top: 5px; font-size: 0.8em;"><a style="color:#ffffff">ENIO MARCELO</a><p><a style="color:#ffffff">&copy 2017</a></p></div>';

/* LOGIN - CHANGE PASSWORD */
$config['CONF_LOGIN_CHANGE_PASS_BG_IMAGE'] = 'style="background: url(' . $_urlBG['changepass'] . ') no-repeat center center; background-size:cover"';
$config['CONF_LOGIN_CHANGE_PASS_LOGO'] = '<div style="color:#000000"><b>Admin</b>' . $config['CONF_TITULO_SISTEMA'] . '</a></div>';
$config['CONF_LOGIN_CHANGE_PASS_FOOTER'] = '<div style="text-align: center; margin-top: 5px; font-size: 0.8em;"><a style="color:#ffffff">ENIO MARCELO</a><p><a style="color:#ffffff">&copy 2017</a></p></div>';

