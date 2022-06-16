$(document).ready(function () {
    var tableName = '#attendanceUserTbl';
    var tbl = $(tableName).DataTable({
        processing: false,
        serverSide: false,
        ordering: false,
        ajax: {
            url: attendanceCreateUrl,
            data: function data(data) {
                data.filter_department = $('#filter_department').find('option:selected').val();
                data.filter_year = $('#filter_year').find('option:selected').val();
                data.filter_semester = $('#filter_semester').find('option:selected').val();
            }
        },
        columns: [
            {
                data: function data(row) {
                    return `${row.first_name} ${row.last_name}`;
                },
                name: 'first_name'
            },
            {
                data: function data(row) {
                    let dateArr = [];
                        $.each(JSON.parse(attendance.replace(/&quot;/g, '"')), function (key, val) {
                            if (val.student_id == row.id) {
                                let dates = val.dates.split(',');
                                dateArr.push({'student': row.id})
                                $.each(dates, function (key, date) {
                                    dateArr.push(date);
                                });
                            }
                        });
                        for (let i = 1; i <= daysInMonth; i++) {
                            if(dateArr.length>0){
                            $.each(dateArr, function (key, value) {
                                if (value.student == row.id) {
                                    let check = '';
                                    if ($.inArray(i.toString(), dateArr) !== -1) {
                                        check = "checked"
                                    }
                                    $('.checkboxes-' + row.id).append(`<span><input type="checkbox" ${check} name="calender[${row.id}][]" value="${i}"></span>`);
                                }
                            });
                            } else {
                                $('.checkboxes-' + row.id).append(`<span><input type="checkbox" name="calender[${row.id}][]" value="${i}"></span>`);
                            }
                        }

                    return `<div class="checkboxes-${row.id} d-flex justify-content-between"></div>`;
                 },
                name: 'id'
            },
            ],
            'fnInitComplete': function fnInitComplete() {
            $('#filter_department,#filter_year,#filter_semester').change(function () {
                $(tableName).DataTable().ajax.reload(null, true);
            });
        }
    });

    $(document).on('click', '.addModal', function () {
        $('#addModal').appendTo('body').modal('show');
    });

    $(document).on('submit', '#addAttendanceForm', function (e) {
        e.preventDefault();
        $.ajax({
            url: attendanceSessionUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                    $('#addModal').modal('hide');
                    window.location = attendanceCreateUrl;
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    let monthDate = moment(year+'-'+month, 'YYYY-MM');
    let daysInMonth = monthDate.daysInMonth();

    for(let i=1; i<=daysInMonth; i++) {
        $('.date_array').append(`<span>${i}</span>`);
    }
    var attendanceTableName = '#attendanceTbl';
    var attendanceTbl = $(attendanceTableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        ajax: {
            url: attendanceUrl,
        },
        columns: [
            {
                data: function data(row) {
                    return `<span>${row.student.first_name}${row.student.last_name}</span>`;
                },
                name: 'id'
            },
            {
                data: function data(row) {
                    return `<span>${row.student.department.department}</span>`;;
                },
                name: 'id'
            },
            {
                data: function data(row) {
                    let months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                    return `<span>${months[row.month-1]}</span>`;
                },
                name: 'id'
            },
            {
                data: function data(row) {
                    return `<span>${row.year}</span>`;
                },
                name: 'id'
            },
            {
                data: function data(row) {
                    return `<span>${row.dates.split(',').length}</span>`;
                },
                name: 'id'
            },
        ],
    });
});
