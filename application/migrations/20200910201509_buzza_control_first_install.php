<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Buzza_control_first_install extends CI_Migration
{

    public function up()
    {

        /**
         * ci_sessions
         */
        if (!$this->db->table_exists('ci_sessions')) {
            $this->db->query("
                CREATE TABLE `ci_sessions` (
                  `id` varchar(40) NOT NULL,
                  `ip_address` varchar(45) NOT NULL,
                  `timestamp` int(10) NOT NULL DEFAULT '0',
                  `data` longtext NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
        }

        /**
         * proj_build
         */
        if (!$this->db->table_exists('proj_build')) {
            $this->db->query("
                CREATE TABLE `proj_build` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `tabela` varchar(255) DEFAULT NULL,
                  `app_nome` varchar(255) NOT NULL,
                  `app_titulo` varchar(255) NOT NULL,
                  `app_icone` varchar(50) DEFAULT NULL,
                  `order_by` longtext,
                  `calendar_inputs` longtext,
                  `ativo` varchar(1) DEFAULT 'N',
                  `type_project` varchar(45) DEFAULT NULL,
                  `app_security` varchar(3) DEFAULT 'SIM',
                  `app_template_padrao` varchar(3) DEFAULT 'SIM',
                  `type_model` varchar(50) NOT NULL DEFAULT 'default',
                  `created_at` datetime DEFAULT NULL,
                  `user_created_at` varchar(250) DEFAULT NULL,
                  `updated_at` datetime DEFAULT NULL,
                  `user_updated_at` varchar(250) DEFAULT NULL,
                  `deleted_at` datetime DEFAULT NULL,
                  `user_deleted_at` varchar(250) DEFAULT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
        }


        /**
         * proj_build_codeeditor
         */
        if (!$this->db->table_exists('proj_build_codeeditor')) {
            $this->db->query("
                CREATE TABLE `proj_build_codeeditor` (
                  `proj_build_id` int(11) NOT NULL,
                  `code_type` varchar(50) NOT NULL,
                  `code_screen` varchar(50) NOT NULL,
                  `code_access_ajax_only` int(1) DEFAULT '0',
                  `copy_script_js_from_form_add_to_form_edit` int(1) DEFAULT '0',
                  `code_type_method` varchar(45) DEFAULT NULL,
                  `code_script` longtext,
                  `created_at` datetime DEFAULT NULL,
                  `user_created_at` varchar(250) DEFAULT NULL,
                  `updated_at` datetime DEFAULT NULL,
                  `user_updated_at` varchar(250) DEFAULT NULL,
                  `deleted_at` datetime DEFAULT NULL,
                  `user_deleted_at` varchar(250) DEFAULT NULL,
                  PRIMARY KEY (`proj_build_id`,`code_type`,`code_screen`),
                  CONSTRAINT `fk_proj_build_codeeditor_proj_build1` FOREIGN KEY (`proj_build_id`) REFERENCES `proj_build` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
        }


        /**
         * proj_build_fields
         */
        if (!$this->db->table_exists('proj_build_fields')) {
            $this->db->query("
                CREATE TABLE `proj_build_fields` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `proj_build_id` int(11) NOT NULL,
                  `screen_type` varchar(45) DEFAULT NULL,
                  `field_name` varchar(255) DEFAULT NULL,
                  `field_type` varchar(45) DEFAULT NULL,
                  `field_length` int(11) DEFAULT NULL,
                  `primary_key` int(11) DEFAULT '0',
                  `order_field_gridlist` int(11) DEFAULT '999',
                  `order_field_form` int(11) DEFAULT '999',
                  `param_gridlist` longtext,
                  `param_formaddedit` longtext,
                  `created_at` datetime DEFAULT NULL,
                  `user_created_at` varchar(250) DEFAULT NULL,
                  `updated_at` datetime DEFAULT NULL,
                  `user_updated_at` varchar(250) DEFAULT NULL,
                  `deleted_at` datetime DEFAULT NULL,
                  `user_deleted_at` varchar(250) DEFAULT NULL,
                  PRIMARY KEY (`id`,`proj_build_id`),
                  KEY `fk_proj_build_fields_proj_build1_idx` (`proj_build_id`),
                  CONSTRAINT `fk_proj_build_fields_proj_build1` FOREIGN KEY (`proj_build_id`) REFERENCES `proj_build` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
                ) ENGINE=InnoDB AUTO_INCREMENT=3545 DEFAULT CHARSET=utf8;
            ");
        }


        /**
         * proj_build_git
         */
        if (!$this->db->table_exists('proj_build_git')) {
            $this->db->query("
                CREATE TABLE `proj_build_git` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `proj_build_id` int(11) DEFAULT NULL,
                  `code_git` char(32) NOT NULL DEFAULT '',
                  `code_script` longtext,
                  `created_at` datetime DEFAULT NULL,
                  `user_created_at` varchar(250) DEFAULT NULL,
                  `updated_at` datetime DEFAULT NULL,
                  `user_updated_at` varchar(250) DEFAULT NULL,
                  `deleted_at` datetime DEFAULT NULL,
                  `user_deleted_at` varchar(250) DEFAULT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=820 DEFAULT CHARSET=utf8;
            ");
        }


        /**
         * sec_aplicativos
         */
        if (!$this->db->table_exists('sec_aplicativos')) {
            $this->db->query("
                CREATE TABLE `sec_aplicativos` (
                  `app_name` varchar(50) NOT NULL,
                  `app_descricao` varchar(255) NOT NULL,
                  `app_ativo` varchar(1) NOT NULL DEFAULT 'Y',
                  `grupo_descricao` longtext,
                  `created_at` datetime DEFAULT NULL,
                  `user_created_at` varchar(250) DEFAULT NULL,
                  `updated_at` datetime DEFAULT NULL,
                  `user_updated_at` varchar(250) DEFAULT NULL,
                  `deleted_at` datetime DEFAULT NULL,
                  `user_deleted_at` varchar(250) DEFAULT NULL,
                  PRIMARY KEY (`app_name`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
        }


        /**
         * sec_auditoria
         */
        if (!$this->db->table_exists('sec_auditoria')) {
            $this->db->query("
                CREATE TABLE `sec_auditoria` (
                  `id` int(8) NOT NULL AUTO_INCREMENT,
                  `inserted_date` datetime DEFAULT NULL,
                  `username` varchar(250) DEFAULT NULL,
                  `application` varchar(200) DEFAULT NULL,
                  `method` varchar(255) DEFAULT NULL,
                  `creator` varchar(30) DEFAULT NULL,
                  `ip_user` varchar(32) DEFAULT NULL,
                  `action` varchar(255) DEFAULT NULL,
                  `description` text,
                  `last_query` longtext,
                  `user_agent` longtext,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=8589 DEFAULT CHARSET=utf8;
            ");
        }


        /**
         * sec_grupos
         */
        if (!$this->db->table_exists('sec_grupos')) {
            $this->db->query("
                CREATE TABLE `sec_grupos` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `descricao` varchar(250) NOT NULL,
                  `ativo` varchar(1) NOT NULL,
                  `app_name` longtext,
                  `app_inicial` varchar(255) DEFAULT NULL,
                  `created_at` datetime DEFAULT NULL,
                  `user_created_at` varchar(250) DEFAULT NULL,
                  `updated_at` datetime DEFAULT NULL,
                  `user_updated_at` varchar(250) DEFAULT NULL,
                  `deleted_at` datetime DEFAULT NULL,
                  `user_deleted_at` varchar(250) DEFAULT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=2009 DEFAULT CHARSET=utf8;
            ");
        }


        /**
         * sec_grupos_has_sec_aplicativos
         */
        if (!$this->db->table_exists('sec_grupos_has_sec_aplicativos')) {
            $this->db->query("
                CREATE TABLE `sec_grupos_has_sec_aplicativos` (
                  `sec_grupos_id` int(11) NOT NULL,
                  `sec_aplicativos_app_name` varchar(50) NOT NULL,
                  PRIMARY KEY (`sec_grupos_id`,`sec_aplicativos_app_name`),
                  KEY `fk_sec_grupos_has_sec_aplicativos_sec_aplicativos1_idx` (`sec_aplicativos_app_name`),
                  KEY `fk_sec_grupos_has_sec_aplicativos_sec_grupos_idx` (`sec_grupos_id`),
                  CONSTRAINT `fk_sec_grupos_has_sec_aplicativos_sec_aplicativos1` FOREIGN KEY (`sec_aplicativos_app_name`) REFERENCES `sec_aplicativos` (`app_name`) ON DELETE CASCADE ON UPDATE NO ACTION,
                  CONSTRAINT `fk_sec_grupos_has_sec_aplicativos_sec_grupos` FOREIGN KEY (`sec_grupos_id`) REFERENCES `sec_grupos` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
        }


        /**
         * sec_menus
         */
        if (!$this->db->table_exists('sec_menus')) {
            $this->db->query("
                CREATE TABLE `sec_menus` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `nome_menu` varchar(255) NOT NULL,
                  `descricao_menu` varchar(255) DEFAULT NULL,
                  `app_name` varchar(50) DEFAULT NULL,
                  `parent_id` int(11) DEFAULT NULL,
                  `ativo` varchar(3) DEFAULT 'Y',
                  `nivel_menu` int(1) DEFAULT '0',
                  `menu_icon` varchar(80) DEFAULT NULL,
                  `created_at` datetime DEFAULT NULL,
                  `user_created_at` varchar(250) DEFAULT NULL,
                  `updated_at` datetime DEFAULT NULL,
                  `user_updated_at` varchar(250) DEFAULT NULL,
                  `deleted_at` datetime DEFAULT NULL,
                  `user_deleted_at` varchar(250) DEFAULT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
            ");
        }


        /**
         * sec_settings
         */
        if (!$this->db->table_exists('sec_settings')) {
            $this->db->query("
                CREATE TABLE `sec_settings` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `nome_config` varchar(255) NOT NULL,
                  `valor_config` varchar(255) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
            ");

            $this->db->query("
                INSERT INTO `sec_settings` (`nome_config`, `valor_config`)
                VALUES
                    ('multiplos_logins', 'NAO'),
                    ('em_manutencao', 'NAO'),
                    ('layout_skin', 'blue'),
                    ('debug_mode', 'NAO'),
                    ('time_render', 'NAO'),
                    ('time_zone', 'Etc/GMT+4'),
                    ('sidebar_collapsed', 'NAO');
    
            ");
        }

        /**
         * sec_usuarios
         */
        if (!$this->db->table_exists('sec_usuarios')) {
            $this->db->query("
                CREATE TABLE `sec_usuarios` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `nome` varchar(250) NOT NULL,
                  `email` varchar(250) NOT NULL,
                  `senha` varchar(255) NOT NULL DEFAULT '',
                  `ativo` varchar(1) NOT NULL DEFAULT 'Y',
                  `super_admin` varchar(1) NOT NULL DEFAULT 'N',
                  `cadastro_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                  `sexo` varchar(1) NOT NULL,
                  `app_inicial` varchar(255) DEFAULT NULL,
                  `ultimo_login` datetime DEFAULT NULL,
                  `app_name` longtext,
                  `grupo_descricao` longtext,
                  `created_at` datetime DEFAULT NULL,
                  `user_created_at` varchar(250) DEFAULT NULL,
                  `updated_at` datetime DEFAULT NULL,
                  `user_updated_at` varchar(250) DEFAULT NULL,
                  `deleted_at` datetime DEFAULT NULL,
                  `user_deleted_at` varchar(250) DEFAULT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
            ");

            $this->db->query("
                INSERT INTO `sec_usuarios` (`nome`, `email`, `senha`, `ativo`, `super_admin`, `cadastro_data`, `sexo`, `app_inicial`, `ultimo_login`, `app_name`, `grupo_descricao`, `created_at`, `user_created_at`, `updated_at`, `user_updated_at`, `deleted_at`, `user_deleted_at`)
                VALUES
                    ('Super Admin', 'admin@admin.com', '$2y$10\$B.XliqHEAzjAjoSQ4re82eVwtZHZL.sUJ0xS5mCUn24DB5pGrnTgG', 'Y', 'Y', '', '', '', '', '', '', NULL, NULL, '', ' - ', NULL, NULL);
            ");
        }


        /**
         * sec_usuarios_has_sec_grupos
         */
        if (!$this->db->table_exists('ci_sessions')) {
            $this->db->query("
                CREATE TABLE `sec_usuarios_has_sec_grupos` (
                  `sec_usuarios_id` int(11) NOT NULL,
                  `sec_grupos_id` int(11) NOT NULL,
                  PRIMARY KEY (`sec_usuarios_id`,`sec_grupos_id`),
                  KEY `fk_sec_usuarios_has_sec_grupos_sec_grupos1_idx` (`sec_grupos_id`),
                  KEY `fk_sec_usuarios_has_sec_grupos_sec_usuarios1_idx` (`sec_usuarios_id`),
                  CONSTRAINT `fk_sec_usuarios_has_sec_grupos_sec_grupos1` FOREIGN KEY (`sec_grupos_id`) REFERENCES `sec_grupos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
                  CONSTRAINT `fk_sec_usuarios_has_sec_grupos_sec_usuarios1` FOREIGN KEY (`sec_usuarios_id`) REFERENCES `sec_usuarios` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
        }


    }

    public function down()
    {
        $this->dbforge->drop_table('sec_grupos_has_sec_aplicativos');
        $this->dbforge->drop_table('sec_usuarios_has_sec_grupos');
        $this->dbforge->drop_table('proj_build_codeeditor');
        $this->dbforge->drop_table('proj_build_fields');

        $this->dbforge->drop_table('ci_sessions');
        $this->dbforge->drop_table('proj_build');
        $this->dbforge->drop_table('proj_build_git');
        $this->dbforge->drop_table('sec_aplicativos');
        $this->dbforge->drop_table('sec_auditoria');
        $this->dbforge->drop_table('sec_grupos');
        $this->dbforge->drop_table('sec_menus');
        $this->dbforge->drop_table('sec_settings');
        $this->dbforge->drop_table('sec_usuarios');

    }

}
