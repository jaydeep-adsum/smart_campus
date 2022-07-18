$(document).ready(function () {
    var tableName = '#instituteTbl';
    var tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        ajax: {
            url: instituteUrl
        },
        columnDefs: [
            {
                'targets': [3],
                'orderable': false,
                'width': '15%'
            },
            {
                "defaultContent": "-",
                "targets": "_all"
            }
        ],
        columns: [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'institute',
                name: 'institute'
            },
            {
                data: 'contact',
                name: 'contact'
            },
            {
                data: function data(row) {
                    var url = instituteUrl + '/' + row.id;
                    return `<div class="d-flex"><a title="Edit" class="btn btn-sm edit-btn" data-id="${row.id}" href="${url}/edit">
            <i class="fa fa-edit"></i>
                </a>&nbsp;<a title="Delete" class="btn btn-sm delete-btn" data-id="${row.id}" href="#">
           <i class="fa-solid fa-trash"></i>
                </a></div>`
                },
                name: 'id',
            }]
    });

    $(document).on('click', '.delete-btn', function (event) {
        var instituteId = $(event.currentTarget).attr('data-id');
        deleteItem(instituteUrl + '/' + instituteId, tableName, 'Institute');
    });
});
