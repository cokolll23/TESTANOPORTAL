"use strict";

if (typeof window.interlabs === "undefined") {
    window.interlabs = {};
}
if (typeof window.interlabs.feedbackform === "undefined") {
    window.interlabs.feedbackform = {};
}
$(document).ready(function () {
    $('body').on('click', '#addBonus', function (e) {
        e.preventDefault();
        //alert(' ok');
        $.ajax({
            url: '/shop-bonus/ajaxLoadEvents.php', // Путь к обработчику
            dataType: 'json',
            method: 'POST',
            data: {
                action: 'propsEventsList',
            },
            success: function (response) {

                document.getElementById('result-container').innerHTML = response.html;
            }
        });
    });
    $('body').on('click', 'ul.ul-events-props li.li-events-prop', function (e) {
        e.preventDefault();
        let _this= $(this);
        let thisId = $(this).attr('id');
        let thisNAME = $(this).text();
        $('#EVENT_CODE').val(thisId);
        $('#EVENT_NAME').val(thisNAME);

        $('.li-events-prop').removeClass('clicked');
        _this.addClass('clicked');

    });

    /**
     * open dialog
     */
    $('.interlabs-feedbackform__container__dialog').each(function () {

        var dialog = $(this);

        var form = dialog.find('form');

        var fields = form.data('validatefields');

        dialog.find('.js-interlabs-feedbackform__dialog__close, .js-interlabs-feedbackform__dialog__cancel-button').on('click', function () {
            window.interlabs.feedbackform.closeDialog(this);
        });
    });

    window.interlabs.feedbackform.closeDialog = function (context) {
        var container = $(context).parents('.interlabs-feedbackform__container:first');
        var dialog = container.find('.interlabs-feedbackform__container__dialog:first');
        dialog.addClass('hidden');
    };

    window.interlabs.feedbackform.closeSuccessDialog = function (context) {
        var container = $(context).parents('.interlabs-feedbackform__container:first');
        var dialogSuccsess = container.find('.interlabs-feedbackform__container-succsess:first');
        var dialog = container.find('.interlabs-feedbackform__container__dialog:first');
        dialogSuccsess.addClass('hidden');
        dialog.removeClass('hidden');
    };
});
//# sourceMappingURL=script.js.map
