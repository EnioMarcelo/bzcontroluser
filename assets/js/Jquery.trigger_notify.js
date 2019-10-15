/* 
 Created on : 15/10/2019, 08:56:38
 Author     : eniomarcelobuzaneli
 */

jQuery(document).ready(function ($) {

    triggerNotify = function (data) {

        if (!data.icon) {
            if (data.color == 'info') {
                data.icon = 'fa fa-info';
            } else if (data.color == 'success') {
                data.icon = 'fa fa-thumbs-up';
            } else if (data.color == 'warning') {
                data.icon = 'fa fa-exclamation-triangle';
            } else if (data.color == 'error') {
                data.icon = 'fa fa-times-circle';
            }
        }

        var triggerContent = "<div class='trigger_notify trigger_notify_" + data.color + "' style='left: 100%; opacity: 0;'>";
        triggerContent += "<p class='margin-top-5'><i style='font-size:1.2em;' class='" + data.icon + " margin-right-5'></i>" + data.title + "</p>";
        triggerContent += "<span class='trigger_notify_timer'></span>";
        triggerContent += "</div>";

        if (!$('.trigger_notify_box').length) {
            $('body').prepend("<div class='trigger_notify_box'></div>");
        }

        $('.trigger_notify_box').prepend(triggerContent);
        $('.trigger_notify').stop().animate({'left': '0', 'opacity': '1'}, 200, function () {
            $(this).find('.trigger_notify_timer').animate({'width': '100%'}, data.timer, 'linear', function () {
                $(this).parent('.trigger_notify').animate({'left': '100%', 'opacity': '0'}, function () {
                    $(this).remove();
                });
            });
        });

        $('body').on('click', '.trigger_notify', function () {
            $(this).animate({'left': '100%', 'opacity': '0'}, function () {
                $(this).remove();
            });
        });
    };

});