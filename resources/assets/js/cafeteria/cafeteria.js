$(document).ready(function () {
    var tableName = '#cafeteriaTbl';
    var tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        // language: {
        //     processing: `<img src='${loaderUrl}'>`,
        // },
        ajax: {
            url: cafeteriaUrl
        },
        columnDefs: [
            {
                'targets': [4],
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
                        </div>`;
                },
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'price',
                name: 'price'
            },
            {
                data: function data(row) {
                    return row.category.name;
                },
                name: 'category'
            },
            {
                data: function data(row) {
                    var url = cafeteriaUrl + '/' + row.id;
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
        var cafeteriaId = $(event.currentTarget).attr('data-id');
        deleteItem(cafeteriaUrl + '/' + cafeteriaId, tableName, 'Cafeteria');
    });
});
