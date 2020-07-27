define([
    "jquery",
    'mage/url',
    'Magento_Checkout/js/model/error-processor',
    "jquery/ui"
], function(
    $,
    url,
    errorProcessor,
){
    "use strict";

    function main(config, element, event) {
        var $element = $(element);
        var dataForm = $('#custom-form');
        dataForm.mage('validation', {});
        $('#submit-button').on('click',function(event) {
            if (dataForm.valid()){
                event.preventDefault();
                $.ajax({
                    url: url.build('pricerequestajax/ajax/index'),
                    data: dataForm.serialize(),
                    type: "POST",
                    dataType: 'json'
                }).done(function () {
                    $('#modal-form').trigger('closeModal');
                    dataForm[0].reset();
                }).fail(function (response) {
                    errorProcessor.process(response);
                })
            }
        });
    }
    return main;
});
