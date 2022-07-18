$(document).ready(function () {
    var tableName = '#categoryTbl';
    var tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        ajax: {
            url: categoryUrl
        },
        columnDefs: [
            {
                'targets': [2],
                'orderable': false,
                'width': '8%'
            },
        ],
        columns: [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: function data(row) {
                    var url = categoryUrl + '/' + row.id;
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
        var categoryId = $(event.currentTarget).attr('data-id');
        deleteItem(categoryUrl + '/' + categoryId, tableName, 'Category');
    });
});
