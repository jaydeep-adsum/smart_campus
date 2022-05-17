$(document).ready(function () {
    var tableName = '#semesterTbl';
    var tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        ajax: {
            url: semesterUrl
        },
        columns: [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'semester',
                name: 'semester'
            },
            {
                data: function data(row) {
                    return moment(row.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY');
                },
                name: 'created_at'
            },
            {
                data: function data(row) {
                    return `<a title="Edit" class="btn btn-sm edit-btn" data-id="${row.id}" href="#">
            <i class="fa fa-edit"></i>
                </a>  <a title="Delete" class="btn btn-sm delete-btn" data-id="${row.id}" href="#">
           <i class="fa-solid fa-trash"></i>
                </a>`
                },
                name: 'id',
            }]
    });

    $(document).on('click', '.addSemesterModal', function () {
        $('#addSemesterModal').appendTo('body').modal('show');
    });
    $(document).on('submit', '#addSemesterForm', function (e) {
        e.preventDefault();
        if ($('#semester').val()=="") {
            displayErrorMessage('Semester Name field is required.');
            return false;
        }
        $.ajax({
            url: semesterSaveUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#addSemesterModal').modal('hide');
                    $(tableName).DataTable().ajax.reload(null, false);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('click', '.edit-btn', function (event) {
        let semesterId = $(event.currentTarget).attr('data-id');
        renderData(semesterId);
    });
    window.renderData = function (id) {
        $.ajax({
            url: semesterUrl + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#editSemester').val(result.data.semester);
                    $('#semesterId').val(result.data.id);
                    $('#editSemesterModal').appendTo('body').modal('show');
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    };

    $(document).on('submit', '#editSemesterForm', function (e) {
        e.preventDefault();
        if ($('#editSemester').val()=="") {
            displayErrorMessage('Semester field is required.');
            return false;
        }
        var id = $('#semesterId').val();
        $.ajax({
            url: semesterUrl +'/'+id,
            type: 'PUT',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#editSemesterModal').modal('hide');
                    $(tableName).DataTable().ajax.reload(null, false);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('click', '.delete-btn', function (event) {
        var semesterId = $(event.currentTarget).attr('data-id');
        deleteItem(semesterUrl + '/' + semesterId, tableName, 'Semester');
    });

    $('#addSemesterModal').on('hidden.bs.modal', function () {
        $('#addSemesterForm')[0].reset();
    });

});