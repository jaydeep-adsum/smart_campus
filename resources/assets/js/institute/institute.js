$(document).ready(function () {
    var tableName = '#instituteTbl';
    var tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        ajax: {
            url: instituteUrl
        },
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
                data: function data(row) {
                    return moment(row.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY');
                },
                name: 'created_at'
            },
            {
                data: function data(row) {
                    var url = instituteUrl + '/' + row.id;
                    return `<a title="Edit" class="btn btn-sm edit-btn" data-id="${row.id}" href="#">
            <i class="fa fa-edit"></i>
                </a>  <a title="Delete" class="btn btn-sm delete-btn" data-id="${row.id}" href="#">
           <i class="fa-solid fa-trash"></i>
                </a>`
                },
                name: 'id',
            }]
    });

    $(document).on('click', '.addInstituteModal', function () {
        $('#addInstituteModal').appendTo('body').modal('show');
    });
    $(document).on('submit', '#addInstituteForm', function (e) {
        e.preventDefault();
        if ($('#institute').val()=="") {
            displayErrorMessage('Institute Name field is required.');
            return false;
        }
        $.ajax({
            url: instituteSaveUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#addInstituteModal').modal('hide');
                    $(tableName).DataTable().ajax.reload(null, false);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('click', '.edit-btn', function (event) {
        let instituteId = $(event.currentTarget).attr('data-id');
        renderData(instituteId);
    });
    window.renderData = function (id) {
        $.ajax({
            url: instituteUrl + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#editInstitute').val(result.data.institute);
                    $('#instituteId').val(result.data.id);
                    $('#editInstituteModal').appendTo('body').modal('show');
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    };

    $(document).on('submit', '#editInstituteForm', function (e) {
        e.preventDefault();
        if ($('#editInstitute').val()=="") {
            displayErrorMessage('Institute field is required.');
            return false;
        }
        $.ajax({
            url: instituteUrl + '/update',
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#editInstituteModal').modal('hide');
                    $(tableName).DataTable().ajax.reload(null, false);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('click', '.delete-btn', function (event) {
        var instituteId = $(event.currentTarget).attr('data-id');
        deleteItem(instituteUrl + '/' + instituteId, tableName, 'Institute');
    });

    $('#addInstituteModal').on('hidden.bs.modal', function () {
        $('#addInstituteForm')[0].reset();
    });

});
