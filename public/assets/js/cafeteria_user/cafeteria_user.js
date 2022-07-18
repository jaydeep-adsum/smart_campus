/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************************************!*\
  !*** ./resources/assets/js/cafeteria_user/cafeteria_user.js ***!
  \**************************************************************/
$(document).ready(function () {
  var tableName = '#yearTbl';
  var tbl = $(tableName).DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    ajax: {
      url: cafeteriaUserUrl
    },
    columnDefs: [{
      'targets': [4],
      'orderable': false,
      'width': '8%'
    }],
    columns: [{
      data: 'id',
      name: 'id'
    }, {
      data: function data(row) {
        return row.user.name;
      },
      name: 'name'
    }, {
      data: function data(row) {
        return row.user.email;
      },
      name: 'email'
    }, {
      data: function data(row) {
        return row.institute.institute;
      },
      name: 'institute'
    }, {
      data: function data(row) {
        return "<div class=\"d-flex\"><a title=\"Edit\" class=\"btn btn-sm edit-btn\" data-id=\"".concat(row.id, "\" href=\"#\">\n            <i class=\"fa fa-edit\"></i>\n                </a>&nbsp;<a title=\"Delete\" class=\"btn btn-sm delete-btn\" data-id=\"").concat(row.id, "\" href=\"#\">\n           <i class=\"fa-solid fa-trash\"></i>\n                </a></div>");
      },
      name: 'id'
    }]
  });
  $(document).on('click', '.addModal', function () {
    $('#addModal').appendTo('body').modal('show');
  });
  $(document).on('submit', '#addForm', function (e) {
    e.preventDefault();
    $.ajax({
      url: cafeteriaUserSaveUrl,
      type: 'POST',
      data: $(this).serialize(),
      success: function success(result) {
        if (result.success) {
          displaySuccessMessage(result.message);
          $('#addModal').modal('hide');
          $(tableName).DataTable().ajax.reload(null, false);
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      }
    });
  });
  $(document).on('click', '.edit-btn', function (event) {
    var user_id = $(event.currentTarget).attr('data-id');
    renderData(user_id);
  });

  window.renderData = function (id) {
    $.ajax({
      url: cafeteriaUserUrl + '/' + id + '/edit',
      type: 'GET',
      success: function success(result) {
        if (result.success) {
          $('#userId').val(result.data.id);
          $('#user_Id').val(result.data.user_id);
          $('#edit_name').val(result.data.user.name);
          $('#edit_email').val(result.data.user.email);
          $('#edit_institute_id').val(result.data.institute_id).trigger("change");
          $('#editModal').appendTo('body').modal('show');
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      }
    });
  };

  $(document).on('submit', '#editForm', function (e) {
    e.preventDefault();
    $.ajax({
      url: cafeteriaUserUrl + '/update',
      type: 'POST',
      data: $(this).serialize(),
      success: function success(result) {
        if (result.success) {
          displaySuccessMessage(result.message);
          $('#editModal').modal('hide');
          $(tableName).DataTable().ajax.reload(null, false);
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      }
    });
  });
  $(document).on('click', '.delete-btn', function (event) {
    var userId = $(event.currentTarget).attr('data-id');
    deleteItem(cafeteriaUserUrl + '/' + userId, tableName, 'Cafeteria user');
  });
  $('#addModal').on('hidden.bs.modal', function () {
    $('#addModal')[0].reset();
  });
});
/******/ })()
;