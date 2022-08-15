'use strict';

$(document).ready(function () {

    $('#facebookUrl').keyup(function () {
        this.value = this.value.toLowerCase();
    });
    $('#twitterUrl').keyup(function () {
        this.value = this.value.toLowerCase();
    });
    $('#instagramUrl').keyup(function () {
        this.value = this.value.toLowerCase();
    });
    $('#linkedInUrl').keyup(function () {
        this.value = this.value.toLowerCase();
    });

    $('#createUserForm, #editUserForm').submit(function () {
        if ($('#error-msg').text() !== '') {
            $('#phoneNumber').focus();
            return false;
        }

        let facebookUrl = $('#facebookUrl').val();
        let twitterUrl = $('#twitterUrl').val();
        let instagramUrl = $('#instagramUrl').val();
        let linkedInUrl = $('#linkedInUrl').val();

        let facebookExp = new RegExp(
            /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)facebook.[a-z]{2,3}\/?.*/i);
        let twitterExp = new RegExp(
            /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)twitter\.[a-z]{2,3}\/?.*/i);
        let instagramUrlExp = new RegExp(
            /^(https?:\/\/)?((w{2,3}\.)?)instagram.[a-z]{2,3}\/?.*/i);
        let linkedInExp = new RegExp(
            /^(https?:\/\/)?((w{2,3}\.)?)linkedin\.[a-z]{2,3}\/?.*/i);

        let facebookCheck = (facebookUrl == '' ? true : (facebookUrl.match(
            facebookExp) ? true : false));
        if (!facebookCheck) {
            displayErrorMessage('Please enter a valid Facebook Url');
            return false;
        }
        let twitterCheck = (twitterUrl == '' ? true : (twitterUrl.match(twitterExp)
            ? true
            : false));
        if (!twitterCheck) {
            displayErrorMessage('Please enter a valid Twitter Url');
            return false;
        }
        let instagramCheck = (instagramUrl == '' ? true : (instagramUrl.match(
            instagramUrlExp) ? true : false));
        if (!instagramCheck) {
            displayErrorMessage('Please enter a valid Instagram Url');
            return false;
        }
        let linkedInCheck = (linkedInUrl == '' ? true : (linkedInUrl.match(
            linkedInExp) ? true : false));
        if (!linkedInCheck) {
            displayErrorMessage('Please enter a valid Linkedin Url');
            return false;
        }
    });

    $('#createUserForm, #editUserForm').
        on('keyup keypress', function (e) {
            let keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });

    $('#dob').flatpickr({
        maxDate: new Date(),
    });

    $(document).on('change', '#profileImage', function () {
        let extension = isValidDocument($(this), '#userValidationErrorsBox');
        if (!isEmpty(extension) && extension != false) {
            $('#userValidationErrorsBox').html('').hide();
            displayDocument(this, '#previewImage', extension);
        }
    });

    window.isValidDocument = function (
        inputSelector, validationMessageSelector) {
        let ext = $(inputSelector).val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) ==
            -1) {
            $(inputSelector).val('');
            $(validationMessageSelector).
                html(
                    'The profile image must be a file of type: jpeg, jpg, png.').
                removeClass('display-none').show();

            setTimeout(function () {
                $(validationMessageSelector).slideUp(300);
            }, 5000);

            return false;
        }
        $(validationMessageSelector).addClass('display-none');

        return ext;
    };

    $(document).on('submit', '#createUserForm, #editUserForm', function () {
        $('#btnSave').attr('disabled', true);
    });

    $(document).on('click', '.remove-image', function () {
        defaultImagePreview('#previewImage', 1);
    });
});
