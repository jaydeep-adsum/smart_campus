$(document).ready(function () {
    var tableName = '#fellowshipTbl';
    var tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        // language: {
        //     processing: `<img src='${loaderUrl}'>`,
        // },
        ajax: {
            url: fellowshipUrl
        },
        columnDefs: [
            {
                'targets': [4],
                'orderable': false,
                'width': '8%'
            },
        ],
        columns: [
            {
                data: 'name',
                name: 'name'
            },
            {
                data: function data(row) {
                    return moment(row.start_date, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY');
                },
                name: 'start_date'
            },
            {
                data: function data(row) {
                    return moment(row.end_date, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY');
                },
                name: 'end_date'
            },
            {
                data: 'web_url',
                name: 'web_url'
            },
            {
                data: function data(row) {
                    var url = fellowshipUrl + '/' + row.id;
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
        var fellowshipId = $(event.currentTarget).attr('data-id');
        deleteItem(fellowshipUrl + '/' + fellowshipId, tableName, 'Fellowship');
    });
});
