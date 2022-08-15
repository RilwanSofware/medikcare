'use strict';
let timeRange = $('#time_range');
var start =  moment().startOf('week');
var end = moment().endOf('week');
let startTime = '';
let endTime = '';

function cb (start, end) {
    $('#time_range').
        html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
}

timeRange.daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [
            moment().subtract(1, 'days'),
            moment().subtract(1, 'days')],
        'This Week': [moment().startOf('week'), moment().endOf('week')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [
            moment().subtract(1, 'month').startOf('month'),
            moment().subtract(1, 'month').endOf('month')],
    },
}, cb);

cb(start, end);
timeRange.on('apply.daterangepicker', function (ev, picker) {
    startTime = picker.startDate.format('YYYY-MM-D  H:mm:ss');
    endTime = picker.endDate.format('YYYY-MM-D  H:mm:ss');
    $('#appointmentsTbl').DataTable().ajax.reload(null, true);
});

let tbl = $('#appointmentsTbl').DataTable({
    searchDelay: 500,
    processing: true,
    serverSide: true,
    'language': {
        'lengthMenu': 'Show _MENU_',
    },
    'order': [7, 'desc'],
    ajax: {
        url: appointmentUrl,
        data: function (data) {
            data.start_date = startTime;
            data.end_date = endTime;
            data.is_completed = $('#status').find('option:selected').val();
        },
    },
    columnDefs: [
        {
            'targets': [3],
            'width': '18%',
        },
        {
            'targets': [4],
            'orderable': false,
            'className': 'text-center text-nowrap',
            'width': '12%',
        },
        {
            'targets': [5, 6],
            'visible': false,
        },
        {
            'targets': [7],
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
                let showLink = patientUrl + '/' + row.patient.id;
                return `<div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="${showLink}">
                            <div>
                                <img src="${row.patientImageUrl}" alt=""
                                     class="user-img">
                            </div>
                        </a>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="${showLink}"
                               class="mb-1">${row.patient.user.full_name}</a>
                            <span>${row.patient.user.email}</span>
                        </div>
                    </div>`;
            },
            name: 'patient.user.first_name',
        },
        {
            data: function (row) {
                if (patientRole) {
                    return row.doctor.user.full_name;
                }
                let showLink = doctorUrl + '/' + row.doctor.id;
                return `<div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="${showLink}">
                            <div>
                                <img src="${row.doctorImageUrl}" alt=""
                                     class="user-img">
                            </div>
                        </a>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="${showLink}"
                               class="mb-1">${row.doctor.user.full_name}</a>
                            <span>${row.doctor.user.email}</span>
                        </div>
                    </div>`;
            },
            name: 'doctor.user.first_name',
        },
        {
            data: function (row) {
                let showLink = doctorDepartmentUrl + '/' +
                    row.doctor.department.id;
                return '<a href="' + showLink + '">' +
                    row.doctor.department.title + '</a>';
            },
            name: 'doctor.department.title',
        },
        {
            data: function (row) {
                return row;
            },
            render: function (row) {
                if (row.opd_date === null) {
                    return 'N/A';
                }

                return `<div class="badge badge-light">
                    <div class="mb-2">${moment(row.opd_date).utc().format('LT')}</div>
                    <div>${moment(row.opd_date).utc().format('Do MMM, Y')}</div>
                </div>`;
            },
            name: 'opd_date',
        },
        {
            data: function (row) {
                let url = appointmentUrl + '/' + row.id;
                let data = [
                    {
                        'id': row.id,
                        'url': url + '/edit',
                        'viewUrl': url,
                        'isDoctor': doctorRole,
                        'is_completed': row.is_completed,
                    }];
                return prepareTemplateRender('#appointmentActionTemplate', data);
            }, name: 'id',
        },
        {
            data: 'patient.user.last_name',
            name: 'patient.user.last_name',
        },
        {
            data: 'doctor.user.last_name',
            name: 'doctor.user.last_name',
        },
        {
            data: 'created_at',
            name: 'created_at',
        },
    ],
    'fnInitComplete': function () {
        $('#status').change(function () {
            $('#appointmentsTbl').DataTable().ajax.reload(null, true);
        });
    },
});
handleSearchDatatable(tbl);

$(document).on('click', '.delete-btn', function (event) {
    let appointmentId = $(event.currentTarget).data('id');
    deleteItem(appointmentUrl + '/' + appointmentId, '#appointmentsTbl',
        'Appointment');
});

$(document).on('click', '#resetFilter', function () {
    startTime = timeRange.data('daterangepicker').
        setStartDate(moment().startOf('week').format('MM/DD/YYYY'));
    endTime = timeRange.data('daterangepicker').
        setEndDate(moment().endOf('week').format('MM/DD/YYYY'));
    $('#status').val(2).trigger('change');
});

$('#status').select2();

$(document).on('click', '.status', function (event) {
    let appointmentId = $(event.currentTarget).data('id');
    completeAppointment(appointmentUrl + '/' + appointmentId + '/status',
        '#appointmentsTbl', 'Appointment Status');
});

$(document).on('click', '.cancel-appointment', function (event) {
    let appointmentId = $(event.currentTarget).data('id');
    cancelAppointment(appointmentUrl + '/' + appointmentId + '/cancel',
        '#appointmentsTbl', 'Appointment');
});

window.completeAppointment = function (url, tableId, header, appointmentId) {
    Swal.fire({
        title: 'Change status !',
        text: 'Are you sure want to change ' + header + ' ?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonColor: '#50cd89',
        showLoaderOnConfirm: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
    }).then(function (result) {
        if (result.isConfirmed) {
            completeAppointmentAjax(url, tableId, header, appointmentId);
        }
    });
};

function completeAppointmentAjax (url, tableId, header, appointmentId) {
    $.ajax({
        url: url,
        type: 'POST',
        success: function (obj) {
            if (obj.success) {
                if ($(tableId).DataTable().data().count() == 1) {
                    $(tableId).DataTable().page('previous').draw('page');
                } else {
                    $(tableId).DataTable().ajax.reload(null, false);
                }
            }
            Swal.fire({
                title: 'Changed Appointment!',
                text: header + ' has been Changed.',
                icon: 'success',
                confirmButtonColor: '#50cd89',
                timer: 2000,
            });
        },
        error: function (data) {
            Swal.fire({
                title: 'Error',
                icon: 'error',
                text: data.responseJSON.message,
                type: 'error',
                confirmButtonColor: '#50cd89',
                timer: 5000,
            });
        },
    });
}

