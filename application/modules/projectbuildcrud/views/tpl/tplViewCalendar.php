<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--
/*
  Created on : 07/11/2019, 10:35AM
  Author     : ENIO MARCELO BUZANELI CDSCSDCS - eniomarcelo@gmail.com
 */
-->
<!-- BREADCUMBS -->
<section class="content-header header-dashboard" style="margin-top: 0px; margin-left: -15px; margin-bottom: 23px;">
    <h1>
        <i class="<?= $_font_icon; ?>"></i>
        <?= $_titulo_app; ?>
        <small class=" ">
            Novo
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard'); ?>" target="_top" class="active btn-show-modal-aguarde"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class=""><a href="<?= site_url($this->router->fetch_class()); ?>" class="btn-show-modal-aguarde"><i class="<?= $_font_icon; ?>"></i><?= $_titulo_app; ?></a></li>
        <li class="active"><i class="fa fa-calendar margin-right-5"></i>Calendário</li>
    </ol>
</section>
<!-- END BREADCUMBS -->
<!-- MENSAGENS -->
<div class="message-toastr"></div>
<?= get_mensagem(); ?>
<!--END MENSAGENS -->



<div class="col-md-12">
    <div class="box box-primary">                                
        <div class="box-body">
            <!-- THE CALENDAR -->
            <div id="calendar"></div>
        </div><!-- /.box-body -->
    </div><!-- /. box -->
</div>

<script type="text/javascript">
    $(function () {

        setTimeout(refreatCalendar, 10000);

        function refreatCalendar() {

            $('#calendar').fullCalendar('rerenderEvents');
            $('#calendar').fullCalendar('refetchEvents');

            setTimeout(refreatCalendar, 10000);

        }

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay',
                timeFormat: {
                    agenda: 'H(:mm)' //h:mm{ - h:mm}'
                }

            },
            buttonText: {//This is to add icons to the visible buttons
                prev: "",
                next: "",
                today: 'Hoje',
                month: 'Mês',
                week: 'Semana',
                day: 'Dia'
            },
            //Random default events
            events: {
                url: '<?= site_url() . $this->router->fetch_class() ?>/calendar/events',
                method: 'POST',
                type: 'json',
                data: {<?= $this->security->get_csrf_token_name(); ?>: '<?= $this->security->get_csrf_hash(); ?>'},
                failure: function () {
                    alert('there was an error while fetching events!');
                }
            },
            timeFormat: 'H(:mm)',
            axisFormat: 'H(:mm)',
            editable: true,
            dayClick: function (date, jsEvent, view) {
                console.log('--> ' + date.format());
                window.location.href = "cadcliente/add";
            },
            eventClick: function (info) {
                console.log('-->' + info.id);
                console.log('-->' + info.start);
            },
            eventRender: function (eventObj, $el) {

                $el.find('.fc-title').parent().prepend('<span class="fa fa-clock-o"></span> ');
                $el.find('.fc-title').prepend('<span class="fa fa-caret-right margin-left-5"></span> ');

                var _startDate = '';
                var _endDate = '';

                if (eventObj.datastart) {
                    _startDate = '<br><b>Início:</b> ' + eventObj.datastart + ' <b>as</b> ' + eventObj.timestart + 'hs';
                }

                if (eventObj.dataend) {
                    _endDate = '<br><b>Término:</b> ' + eventObj.dataend + ' <b>as</b> ' + eventObj.timeend + 'hs';
                }

                $el.popover({
                    title: '<b>' + eventObj.title + '</b>',
                    content: '<b>Descrição:</b> ' + eventObj.description + _startDate + _endDate,
                    trigger: 'hover',
                    placement: 'top',
                    container: 'body',
                    html: 'true'
                });
            }


        }
        );
    });
</script>
