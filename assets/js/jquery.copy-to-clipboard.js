/*
 * Copyright (c) 2016 Milan Kyncl
 * Licensed under the MIT license.
 *
 * jquery.copy-to-clipboard plugin
 * https://github.com/mmkyncl/jquery-copy-to-clipboard
 * https://www.jqueryscript.net/text/jQuery-Plugin-To-Copy-Any-Text-Into-Your-Clipboard-Copy-to-Clipboard.html
 *
 */

$.fn.CopyToClipboard = function () {
    var textToCopy = false;
    if (this.is('select') || this.is('textarea') || this.is('input')) {
        textToCopy = this.val();
    } else {
        textToCopy = this.text();
    }
    CopyToClipboard(textToCopy);

};

function CopyToClipboard(val, _msg) {

    var param = [];
    param['title'] = "Copaido com sucesso!";
    param['color'] = "success";
    param['timer'] = 3000;

    triggerNotify(param);

    var hiddenClipboard = $('#_hiddenClipboard_');
    if (!hiddenClipboard.length) {
        $('body').append('<textarea style="position:absolute;top: -9999px;" id="_hiddenClipboard_"></textarea>');
        hiddenClipboard = $('#_hiddenClipboard_');
    }
    hiddenClipboard.html(val);
    hiddenClipboard.select();
    document.execCommand('copy');
    document.getSelection().removeAllRanges();

    if ($("#codeeditor_1").length) {
        editAreaLoader.setSelectedText('codeeditor_1', val);
    }

}

$(function () {

    $('[data-clipboard-target]').each(function () {
        $(this).click(function () {
            $($(this).data('clipboard-target')).CopyToClipboard();
        });
    });
    $('[data-clipboard-text]').each(function () {
        $(this).click(function () {
            CopyToClipboard($(this).data('clipboard-text'), $(this).data('clipboard-message'));
        });
    });

});