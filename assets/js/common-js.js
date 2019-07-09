/**
 * LIGA O MODAL DE AGUARDE DEPOIS QUE CARREGA TODO O CONTEÚDO
 */
$(function () {
    $('.btn-show-modal-aguarde').on('click', function (event) {
        $('#modal-aguarde').modal({
            backdrop: 'static',
            keyboard: false,
            show: true,
        });
    });
});

function fcnShowModalAguarde() {

    $('#modal-aguarde').modal({
        backdrop: 'static',
        keyboard: false,
        show: true,
    });

}



/**
 * DESLIGA O MODAL DE AGUARDE DEPOIS QUE CARREGA TODO O CONTEÚDO
 */
$(function () {
    parent.$('#modal-aguarde').modal('hide');
});


function fcnHideModalAguarde() {
    $('#modal-aguarde').modal('hide');
}



/*
 * TIMER PARA APAGAR O ALERT
 */
$(function () {
    setTimeout(function () {
        $('.alert').fadeOut(1000);
    }, 3000);
});



/*
 * TOOLTIP
 */
$(function () {
    $('.j-tooltip').tooltip({html: true});

});



/*
 * POPOVER
 */
$(function () {
    $('[data-toggle="popover"]').popover({html: true, trigger: 'click'});
    $('body').on('click', function (e) {
        $('[data-toggle="popover"]').each(function () {
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });
});


/**
 * LIGHTBOX POPUP
 */
lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true
});

