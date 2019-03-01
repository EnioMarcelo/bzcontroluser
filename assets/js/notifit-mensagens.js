function notfit_msg_error(msg) {
    notif({
        type: "error",
        msg: "<i class='icon fa fa-thumbs-down'></i><b> Erro! </b>"+msg,
        position: "center",
        width: 650,
        height: 60,
        autohide: true,
        opacity: 1
    });
}


function notfit_msg_warning(msg) {
    notif({
        type: "warning",
        msg: "<i class='icon fa fa-warning'></i><b> Atenção! </b>"+msg,
        position: "center",
        width: 650,
        height: 60,
        autohide: true,
        opacity: 1
    });
}

function notfit_msg_warning2(msg) {
    notif({
        type: "warning",
        msg: "<i class='icon fa fa-warning'></i><b> Atenção! </b>"+msg,
        position: "center",
        width: 750,
        height: 60,
        autohide: true,
        opacity: 1
    });
}


function notfit_msg_info(msg) {
    notif({
        type: "info",
        msg: "<i class='icon fa fa-info-circle'></i><b> Informação! </b>"+msg,
        position: "center",
        width: 650,
        height: 60,
        autohide: true,
        opacity: 1
    });
}


function notfit_msg_success(msg) {
    notif({
        type: "success",
        msg: "<i class='icon fa fa-thumbs-up'></i><b> Sucesso! </b>"+msg,
        position: "center",
        width: 650,
        height: 60,
        autohide: true,
        opacity: 1
    });
}