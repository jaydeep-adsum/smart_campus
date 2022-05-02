$(document).ready(function () {
    var tableName = '#noteTbl';
    var tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        // language: {
        //     processing: `<img src='${loaderUrl}'>`,
        // },
        ajax: {
            url: notesUrl
        },
        columnDefs: [
            {
                'targets': [0],
                'orderable': false
            },
            //     {
            //         'targets': [2],
            //         'width': '15%'
            //     },
            // {
            //     'targets': [7],
            //     'orderable': false,
            //     'className': 'text-center',
            //     'width': '9%'
            // },
            //     {
            //         'targets': [6,7],
            //         'className': 'text-center',
            //         'width': '10%'
            //     }
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
                data: 'chapter',
                name: 'chapter'
            },
            {
                data: 'year',
                name: 'year'
            },
            {
                data: 'stream',
                name: 'stream'
            },
            {
                data: function data(row) {
                    let pdf = 'N/A';
                    if (row.pdf_url) {
                        pdf = `<a title="Download" class="btn btn-sm edit-btn" href="${row.pdf_url}">
                        <i class="fa-solid fa-download"></i>
                </a>`;
                    }
                    return pdf;
                },
                name: 'id'
            },
            {
                data: function data(row) {
                    return moment(row.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY');
                },
                name: 'created_at'
            },
            {
                data: function data(row) {
                    var url = notesUrl + '/' + row.id;
                    return `<a title="Edit" class="btn btn-sm edit-btn" data-id="${row.id}" href="${url}/edit">
            <i class="fa fa-edit"></i>
                </a>  <a title="Delete" class="btn btn-sm delete-btn" data-id="${row.id}" href="${url}/delete">
           <i class="fa-solid fa-trash"></i>
                </a>`
                },
                name: 'id',
            }]
    });
});
