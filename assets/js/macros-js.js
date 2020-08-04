/**
 * MACRO QUE GERA UMA MENSAGEM POPUP SWEET ALERT
 */
function mc_sweet_alert(_title, _text, _type = "success") {

    swal(
        _title,
        _text,
        _type /* Tipos de Mensagens: success, warning, error */
    );

}

/**
 *  MACRO QUE GERA UMA MENSAGEM NOTIFIT
 */
function mc_notfit_alert(_text, _type = "info") {

    if (_type == 'info') {
        notfit_msg_info(_text);/* Tipos de Mensagens: _success, _warning, _error */
    } else if (_type == 'success') {
        notfit_msg_success(_text);/* Tipos de Mensagens: _success, _warning, _error */
    } else if (_type == 'warning') {
        notfit_msg_warning(_text);/* Tipos de Mensagens: _success, _warning, _error */
    } else if (_type == 'error') {
        notfit_msg_error(_text);/* Tipos de Mensagens: _success, _warning, _error */
    }


}


/**
 *  MACRO QUE GERA UMA MENSAGEM TOASTER
 *
 * Position : top-left, top-center, top-right, bottom-left, bottom-center, bottom-right
 * Icon:        info, success,  warning, error
 * loaderBg: #29a7d8, #0c660f, #f29a0c, #8e0705
 */
function mc_toast_alert(_title, _text, _position = "top-center", _type = "info") {


    if (_type == 'info') {

        $.toast({
            heading: _title,
            text: _text,
            position: _position,
            icon: _type,
            loaderBg: '#29a7d8'
        });

    } else if (_type == 'success') {

        $.toast({
            heading: _title,
            text: _text,
            position: _position,
            icon: _type,
            loaderBg: '#0c660f'
        });

    } else if (_type == 'warning') {

        $.toast({
            heading: _title,
            text: _text,
            position: _position,
            icon: _type,
            loaderBg: '#f29a0c'
        });

    } else if (_type == 'error') {

        $.toast({
            heading: _title,
            text: _text,
            position: _position,
            icon: _type,
            loaderBg: '#8e0705'
        });

    }


}
