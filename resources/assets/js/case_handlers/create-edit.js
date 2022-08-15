$(document).ready(function () {
    'use strict';

    $('#birthDate').flatpickr({
        maxDate: new Date()
    });

    $('#createCaseHandlerForm, #editCaseHandlerForm').submit(function () {
        if ($('#error-msg').text() !== '') {
            $('#phoneNumber').focus();
            return false;
        }
    });
    $('#createCaseHandlerForm, #editCaseHandlerForm').find('input:text:visible:first').focus();

    $(document).on('click', '.remove-image', function () {
        defaultImagePreview('#previewImage', 1);
    });
});
