$(document).ready(function () {
    var tableName = '#studentTbl';
    var tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,

        ajax: {
            url: studentUrl,
            data: function (d) {
                    d.institute_id = $('#institute_id').val(),
                    d.department_id = $('#department_id').val(),
                    d.semester_id = $('#semester_id').val(),
                    d.year_id = $('#year_id').val()
                    // d._token = '{{csrf_token()}}'
            }
        },
        columnDefs: [
            {
                'targets': [7],
                'className': 'text-center',
                'orderable': false,
                'width': '8%'
            }
        ],
        columns: [
            {
                data: function data(row) {
                    return `<div class="d-flex align-items-center">
                            <div class="mr-2">
                        <div class=""><img src="${row.image_url}" alt="" class="user-img rounded-circle" height="30px" width="30px"></div></div>
                        <div class="d-flex flex-column">${row.first_name} ${row.last_name}</a>
                        </div></div>`;
                },
                name: 'first_name'
            },
            {
                data: 'student_id',
                name: 'student_id'
            },
            {
                data: 'mobile_no',
                name: 'mobile_no'
            },
            {
                data: function data(row) {
                    return row.institute.institute;
                },
                name: 'institute_id'
            },
            {
                data: function data(row) {
                    return row.department.department;
                },
                name: 'department_id'
            },
            {
                data: function data(row) {
                    return row.year.year;
                },
                name: 'year_id'
            },
            {
                data: function data(row) {
                    return row.semester.semester;
                },
                name: 'semester_id'
            },
            {
                data: function data(row) {
                    var url = studentUrl + '/' + row.id;
                    return `<div class="d-flex"><a title="Edit" class="btn btn-sm edit-btn" data-id="${row.id}" href="${url}/edit">
            <i class="fa fa-edit"></i>
                </a>&nbsp;<a title="Delete" class="btn btn-sm delete-btn text-white" data-id="${row.id}" href="#">
           <i class="fa-solid fa-trash"></i>
                </a></div>`
                },
                name: 'id',
            }]
    });
    $("#institute_id").change(function () {
        $(tableName).DataTable().draw(true);
    });
    $("#year_id").change(function () {
        $(tableName).DataTable().draw(true);
    });
    $("#department_id").change(function () {
        $(tableName).DataTable().draw(true);
    });
    $("#semester_id").change(function () {
        $(tableName).DataTable().draw(true);
    });
    $(document).on('click', '.delete-btn', function (event) {
        var studentId = $(event.currentTarget).attr('data-id');
        deleteItem(studentUrl + '/' + studentId, tableName, 'Student');
    });
});
