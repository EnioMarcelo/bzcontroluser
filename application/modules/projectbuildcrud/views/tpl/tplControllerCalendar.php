/* CALENDAR */

    public function calendar($_p = null) {


        if ($_p == 'events') {

            $_colorPast = '#f56954';
            $_colorPresent = '#00924E';
            $_colorFuture = '#337CA5';
            
            $_colorEvent = 'black';

            $_arr = [];

            $_arr[] = [
                'title' => 'Título do Evento - 1',
                'description' => 'Descrição do Evento - 1',
                'start' => '2019-11-01T11:33',
                'end' => '2019-11-01T18:00',
                'backgroundColor' => $_colorEvent,
                'borderColor' => $_colorEvent,
                'id' => '500',
                'datastart' => '01/11/2019',
                'timestart' => '11:33',
                'dataend' => '',
                'timeend' => ''
            ];

            $_arr[] = [
                'title' => 'Título do Evento - 4',
                'description' => 'Descrição do Evento - 4',
                'start' => '2019-11-01T17:33',
                'end' => '',
                'backgroundColor' => $_colorEvent,
                'borderColor' => $_colorEvent,
                'id' => '600',
                'datastart' => '01/11/2019',
                'timestart' => '17:33',
                'dataend' => '01/11/2019',
                'timeend' => '19:00'
            ];

            $_arr[] = [
                'title' => 'Título do Evento - 4',
                'description' => 'Descrição do Evento - 4',
                'start' => '2019-11-02T08:01',
                'end' => '',
                'backgroundColor' => $_colorEvent,
                'borderColor' => $_colorEvent,
                'id' => '600',
                'datastart' => '02/11/2019',
                'timestart' => '08:01',
                'dataend' => '02/11/2019',
                'timeend' => '09:01'
            ];

            $_arr[] = [
                'title' => 'Título do Evento - 2',
                'description' => 'Descrição do Evento - 2',
                'start' => '2019-11-07T09:15',
                'end' => '2019-11-07T19:00',
                'backgroundColor' => $_colorEvent,
                'borderColor' => $_colorEvent,
                'id' => '700',
                'datastart' => '07/11/2019',
                'timestart' => '17:33',
                'dataend' => '08/11/2019',
                'timeend' => '19:00'
            ];

            $_arr[] = [
                'title' => 'Título do Evento - 3',
                'description' => 'Descrição do Evento - 3',
                'start' => '2019-11-09T13:13',
                'end' => '2019-11-11T10:15',
                'backgroundColor' => $_colorEvent,
                'borderColor' => $_colorEvent,
                'id' => '800',
                'datastart' => '09/11/2019',
                'timestart' => '08:00',
                'dataend' => '11/11/2019',
                'timeend' => '10:15'
            ];

            $_arr[] = [
                'title' => 'Título do Evento - 5',
                'description' => 'Descrição do Evento - 5',
                'start' => '2019-12-01T13:13',
                'end' => '2019-12-01T10:15',
                'backgroundColor' => $_colorEvent,
                'borderColor' => $_colorEvent,
                'id' => '800',
                'datastart' => '01/12/2019',
                'timestart' => '08:00',
                'dataend' => '01/12/2019',
                'timeend' => '10:15'
            ];


            echo json_encode($_arr);
            exit;
        }





        /**
         * CSS
         */
        $this->dados['external_css'] = [
            base_url() . "assets/plugins/fullcalendar/fullcalendar.min.css'?'" . date('YmdHis')
        ];

        /**
         * JS
         */
        $this->dados['external_js'] = [
            base_url() . "assets/plugins/fullcalendar/fullcalendar.min.js?v=" . date('YmdHis')
        ];


        /* TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA */
        $this->dados['_conteudo_masterPageIframe'] = $this->dados['_view_app_calendar'];
        $this->load->view('vMasterPageIframe', $this->dados);
    }

    /* END CALENDAR */