$(document).ready(function () {
    'use strict';
    let tableName = '#bedsAssigns';
    let tbl = $(tableName).DataTable({
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
    });
    handleSearchDatatable(tbl);
});
