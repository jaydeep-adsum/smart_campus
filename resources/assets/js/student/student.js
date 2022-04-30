$(document).ready(function () {
    var tableName = '#studentTbl';
    var tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        // language: {
        //     processing: `<img src='${loaderUrl}'>`,
        // },
        ajax: {
            url: studentUrl
        },
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
                data: 'institute_name',
                name: 'institute_name'
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
                data: 'mobile_no',
                name: 'mobile_no'
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
                </a>  <a title="Delete" class="btn btn-sm delete-btn" data-id="${row.id}" href="${url}/delete">
           <i class="fa-solid fa-trash"></i>
                </a>`
                },
                name: 'id',
        }]
});
});
