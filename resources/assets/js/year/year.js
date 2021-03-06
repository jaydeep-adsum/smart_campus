$(document).ready(function () {
    var tableName = '#yearTbl';
    var tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        ajax: {
            url: yearUrl
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
                data: 'year',
                name: 'year'
            },
            {
                data: function data(row) {
                    return `<div class="d-flex"><a title="Edit" class="btn btn-sm edit-btn" data-id="${row.id}" href="#">
            <i class="fa fa-edit"></i>
                </a>&nbsp;<a title="Delete" class="btn btn-sm delete-btn" data-id="${row.id}" href="#">
           <i class="fa-solid fa-trash"></i>
                </a></div>`
                },
                name: 'id',
            }]
    });

    $(document).on('click', '.addYearModal', function () {
        $('#addYearModal').appendTo('body').modal('show');
    });
    $(document).on('submit', '#addYearForm', function (e) {
        e.preventDefault();
        if ($('#year').val()=="") {
            displayErrorMessage('Year field is required.');
            return false;
        }
        $.ajax({
            url: yearSaveUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#addYearModal').modal('hide');
                    $(tableName).DataTable().ajax.reload(null, false);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('click', '.edit-btn', function (event) {
        let yearId = $(event.currentTarget).attr('data-id');
        renderData(yearId);
    });
    window.renderData = function (id) {
        $.ajax({
            url: yearUrl + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#editYear').val(result.data.year);
                    $('#yearId').val(result.data.id);
                    $('#edit_institute_id').val(result.data.institute_id).trigger("change");
                    $('#editYearModal').appendTo('body').modal('show');
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    };

    $(document).on('submit', '#editYearForm', function (e) {
        e.preventDefault();
        if ($('#editYear').val()=="") {
            displayErrorMessage('Year field is required.');
            return false;
        }
        var id = $('#yearId').val();
        $.ajax({
            url: yearUrl +'/'+id,
            type: 'PUT',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#editYearModal').modal('hide');
                    $(tableName).DataTable().ajax.reload(null, false);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('click', '.delete-btn', function (event) {
        var yearId = $(event.currentTarget).attr('data-id');
        deleteItem(yearUrl + '/' + yearId, tableName, 'Year');
    });

    $('#addYearModal').on('hidden.bs.modal', function () {
        $('#addYearForm')[0].reset();
    });

});
