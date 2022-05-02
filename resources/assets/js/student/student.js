$(document).ready(function () {
    var tableName = '#studentTbl';
    var tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,

        ajax: {
            url: studentUrl
        },
        columnDefs: [
            {
                'targets': [1, 2, 3, 8],
                'className': 'text-center',
                'width': '10%'
            },
            {
                'targets': [4],
                'width': '12%'
            },
            {
                'targets': [6],
                'width': '2%'
            },
            {
                'targets': [9],
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
                        <div class="d-flex flex-column">${row.first_name} ${row.last_name}</a><span>${row.email}</span>
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
                    return moment(row.dob, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY');
                },
                name: 'dob'
            },
            {
                data: 'institute_name',
                name: 'institute_name'
            },
            {
                data: 'department',
                name: 'department'
            },
            {
                data: 'year',
                name: 'year'
            },
            {
                data: 'semester',
                name: 'semester'
            },
            {
                data: function data(row) {
                    return moment(row.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY');
                },
                name: 'created_at'
            },
            {
                data: function data(row) {
                    var url = studentUrl + '/' + row.id;
                    return `<a title="Edit" class="btn btn-sm edit-btn" data-id="${row.id}" href="${url}/edit">
            <i class="fa fa-edit"></i>
                </a>  <a title="Delete" class="btn btn-sm delete-btn text-white" data-id="${row.id}" href="#">
           <i class="fa-solid fa-trash"></i>
                </a>`
                },
                name: 'id',
            }]
    });
    $(document).on('click', '.delete-btn', function (event) {
        var studentId = $(event.currentTarget).attr('data-id');
        deleteItem(studentUrl + '/' + studentId, tableName, 'Student');
    });
});
