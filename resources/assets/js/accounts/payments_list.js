$(document).ready(function () {
    'use strict';
    let tableName = '#accountPayments';
    let tbl = $(tableName).DataTable({
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
    });
    handleSearchDatatable(tbl);
});
