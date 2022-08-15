'use strict';

$(document).ready(function () {

    let tbl = $('#doctorsDepartmentsTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [2, 'desc'],
        ajax: {
            url: doctorDepartmentUrl,
        },
        columnDefs: [
            {
                'targets': [1],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
            },
            {
                'targets': [2],
                'visible': false,
            },
            {
                targets: '_all',
                defaultContent: 'N/A',
                'className': 'text-start align-middle text-nowrap',
            },
        ],
        columns: [
            {
                data: function (row) {
                    let showLink = doctorDepartmentUrl + '/' + row.id;
                    return '<a href="' + showLink + '">' + row.title + '</a>';
                },
                name: 'title',
            },
            {
                data: function (row) {
                    let data = [{ 'id': row.id }];
                    return prepareTemplateRender('.modalActionTemplate', data);
                }, name: 'id',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
    });

    handleSearchDatatable(tbl);

    $(document).on('click', '.delete-btn', function (event) {
        let doctorDepartmentId = $(event.currentTarget).data('id');
        deleteItem(
            doctorDepartmentUrl + '/' + doctorDepartmentId,
            '#doctorsDepartmentsTable',
            'Doctor Department',
        );
    });

    $(document).on('submit', '#addNewForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#btnSave');
        loadingButton.button('loading');
        $.ajax({
            url: doctorDepartmentCreateUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#addModal').modal('hide');
                    tbl.ajax.reload(null, false);
                }
            },
            error: function (result) {
                printErrorMessage('#validationErrorsBox', result);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
    });

    $(document).on('click', '.edit-btn', function (event) {
        if (ajaxCallIsRunning) {
            return;
        }
        ajaxCallInProgress();
        let doctorDepartmentId = $(event.currentTarget).data('id');
        renderData(doctorDepartmentId);
    });

    window.renderData = function (id) {
        $.ajax({
            url: doctorDepartmentUrl + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#doctorDepartmentId').val(result.data.id);
                    $('#editTitle').val(result.data.title);
                    $('#editDescription').val(result.data.description);
                    $('#editModal').modal('show');
                    ajaxCallCompleted();
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    };

    $(document).on('submit', '#editForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#btnEditSave');
        loadingButton.button('loading');
        let id = $('#doctorDepartmentId').val();
        $.ajax({
            url: doctorDepartmentUrl + '/' + id,
            type: 'patch',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#editModal').modal('hide');
                    $('#doctorsDepartmentsTable').
                        DataTable().
                        ajax.
                        reload(null, false);
                }
            },
            error: function (result) {
                UnprocessableInputError(result);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
    });

    $('#addModal').on('hidden.bs.modal', function () {
        resetModalForm('#addNewForm', '#validationErrorsBox');
    });

    $('#editModal').on('hidden.bs.modal', function () {
        resetModalForm('#editForm', '#editValidationErrorsBox');
    });
});
