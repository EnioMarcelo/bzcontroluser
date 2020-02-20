/** CALENDAR */

    public function calendar($_p = null) {
       
        $this->session->set_flashdata('btn_voltar_link', site_url($this->router->fetch_class()) . '/calendar?' . bz_app_parametros_url());

        if ($_p == 'events') {
        
            $_colorPast = '#f56954';
            $_colorPresent = '#00924E';
            $_colorFuture = '#337CA5';
            $_colorEvent = 'black';
            $_arr = [];
             
            $_findWhereTable = $this->table_gridlist_name;
            $_findWhere = "WHERE "{{calendar-input-date-start}}" >= '".$this->input->post('start')."' AND  "{{calendar-input-date-end}}" <= '".$this->input->post('end')."'";
            
            $_resultCalendar = mc_selectDataDB( $_findWhereTable, (!empty($_findWhere) ? $_findWhere : ''), (!empty($_findParam) ? $_findParam : '') )->result();
            
            foreach ($_resultCalendar as $_key => $_event) {

                $_dateStart = mc_format_date($_event->"{{calendar-input-date-start}}", 'Y-m-d H:i');
                $_dateEnd = mc_format_date($_event->"{{calendar-input-date-end}}", 'Y-m-d H:i');
                $_dateNow = date('Y-m-d H:i');

                
                if ( $_dateNow > $_dateStart && $_dateNow > $_dateEnd ) {
                    $_colorEvent = $_colorPast;
                } elseif ($_dateNow >= $_dateStart && $_dateNow <= $_dateEnd) {
                    $_colorEvent = $_colorPresent;
                } elseif ( $_dateStart > $_dateNow && $_dateEnd > $_dateNow ) {
                    $_colorEvent = $_colorFuture;
                }
                

                $_arr[] = [
                    'title' => $_event->"{{calendar-input-title}}",
                    'description' => $_event->"{{calendar-input-description}}",
                    'start' => str_replace('##', 'T', mc_format_date($_event->"{{calendar-input-date-start}}", 'Y-m-d##H:i')),
                    'end' => str_replace('##', 'T', mc_format_date($_event->"{{calendar-input-date-end}}", 'Y-m-d##H:i')),
                    'backgroundColor' => $_colorEvent,
                    'borderColor' => $_colorEvent,
                    'id' => $_event->"{{calendar-input-id}}",
                    'datastart' => mc_format_date($_event->"{{calendar-input-date-start}}", 'd/m/Y'),
                    'timestart' => mc_format_date($_event->"{{calendar-input-date-start}}", 'H:i'),
                    'dataend' => mc_format_date($_event->"{{calendar-input-date-end}}", 'd/m/Y'),
                    'timeend' => mc_format_date($_event->"{{calendar-input-date-end}}", 'H:i'),
                ];
            }

            echo json_encode($_arr);
            exit;
        }


        /**
         * CSS
         */
        $this->dados['external_css'] = [
            base_url() . "assets/plugins/fullcalendar/fullcalendar.min.css"
        ];

        /**
         * JS
         */
        $this->dados['external_js'] = [
            base_url() . "assets/plugins/fullcalendar/fullcalendar.min.js",
            base_url() . "assets/plugins/fullcalendar/lang-all.js"
            
        ];


        /** TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA */
        $this->dados['_conteudo_masterPageIframe'] = $this->dados['_view_app_calendar'];
        $this->load->view('vMasterPageIframe', $this->dados);
    }

    /** END CALENDAR */