'use strict';

$(document).ready(function () {
    let tbl = $('#employeeNoticeBoardsTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[1, 'desc']],
        ajax: {
            url: noticeBoardUrl,
        },
        columnDefs: [
            {
                'targets': [0, 1],
                'width': '50%',
            },
            {
                'targets': [2],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
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
                    let showLink = noticeBoardShowUrl + '/' + row.id;
                    return row.title;
                },
                name: 'title',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.created_at === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.created_at).utc().format('LT')}</div>
                                <div>${moment(row.created_at).utc().format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'created_at',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                        }];
                    return prepareTemplateRender('#noticeBoardActionTemplate',
                        data);
                }, 
                name: 'id',
            },
        ],
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '.view-btn', function (event) {
    event.preventDefault();
    let noticeBoardId = $(event.currentTarget).data('id');
    $.ajax({
        url: noticeBoardUrl + '/' + noticeBoardId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showTitle').html('');
                $('#showDescription').html('');
                $('#showTitle').append(result.data.title);
                $('#showDescription').append(result.data.description);
                $('#showModal').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
});
