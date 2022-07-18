$(document).ready(function () {
    var tableName = '#opportunityTbl';
    var tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        ajax: {
            url: opportunityUrl
        },
        columnDefs: [
          {
                'targets': [5,6],
                'orderable': false,
                'className': 'text-center',
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
                data: 'company_name',
                name: 'company_name'
            },
            {
                data: function data(row) {
                    return moment(row.interview_date, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY H:mm');
                },
                name: 'interview_date'
            },
            {
                data: 'location',
                name: 'location'
            },
            {
                data: 'criteria',
                name: 'criteria'
            },
            {
                data: function data(row) {
                    return `<a href="${row.overview}" class="btn btn-sm edit-btn"><i class="fa-solid fa-eye"></i></a>`;
                },
                name: 'overview'
            },
            {
                data: function data(row) {
                    var url = opportunityUrl + '/' + row.id;
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
        var opportunityId = $(event.currentTarget).attr('data-id');
        deleteItem(opportunityUrl + '/' + opportunityId, tableName, 'Opportunity');
    });
});
