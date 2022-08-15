$(document).ready(function () {
    'use strict';

    $('#bloodGroup').select2({
        width: '100%',
    });
    let birthDate = $('#birthDate').flatpickr({
        dateFormat: 'Y-m-d',
        useCurrent: false,
    });
    // birthDate.setDate(isEmpty($('#birthDate').val()) ? new Date() : $('#birthDate').val());
    birthDate.set('maxDate', new Date());

    $('#departmentId').select2({
        width: '100%',
    });

    $('#createPharmacistForm, #editPharmacistForm').find('input:text:visible:first').focus();

    $('#createPharmacistForm, #editPharmacistForm').submit(function () {
        if ($('#error-msg').text() !== '') {
            $('#phoneNumber').focus();
            return false;
        }
    });
    $(document).on('click', '.remove-image', function () {
        defaultImagePreview('#previewImage', 1);
    });
});
