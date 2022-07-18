$(document).ready(function () {
    var tableName = '#textBookTbl';
    var tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        // language: {
        //     processing: `<img src='${loaderUrl}'>`,
        // },
        ajax: {
            url: textBooksUrl
        },
        columnDefs: [
            {
                'targets': [0],
                'orderable': false
            },
            {
                'targets': [5],
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
                data: 'title',
                name: 'title'
            },
            {
                data: 'written_by',
                name: 'written_by'
            },
            {
                data: function data(row) {
                    return row.department.department;
                },
                name: 'department_id'
            },
            {
                data: function data(row) {
                    let pdf = 'N/A';
                    if (row.pdf_url) {
                        pdf = `<a title="Download" class="btn btn-sm edit-btn" href="${row.pdf_url}" download>
                        <i class="fa-solid fa-download"></i>
                </a>`;
                    }
                    return pdf;
                },
                name: 'id'
            },
            {
                data: function data(row) {
                    var url = textBooksUrl + '/' + row.id;
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
        var textBookId = $(event.currentTarget).attr('data-id');
        deleteItem(textBooksUrl + '/' + textBookId, tableName, 'Text Book');
    });
});
