$(document).ready(function () {
    'use strict';

    $('#paymentDate').flatpickr({
        dateFormat: 'Y-m-d',
    });

    $('select').focus();

    $('.price-input').trigger('input');
});
