/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************************!*\
  !*** ./resources/assets/js/institute/institute.js ***!
  \****************************************************/
$(document).ready(function () {
  var tableName = '#instituteTbl';
  var tbl = $(tableName).DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    ajax: {
      url: instituteUrl
    },
    columnDefs: [{
      'targets': [3],
      'orderable': false,
      'width': '15%'
    }, {
      "defaultContent": "-",
      "targets": "_all"
    }],
    columns: [{
      data: 'id',
      name: 'id'
    }, {
      data: 'institute',
      name: 'institute'
    }, {
      data: 'contact',
      name: 'contact'
    }, {
      data: function data(row) {
        var url = instituteUrl + '/' + row.id;
        return "<div class=\"d-flex\"><a title=\"Edit\" class=\"btn btn-sm edit-btn\" data-id=\"".concat(row.id, "\" href=\"").concat(url, "/edit\">\n            <i class=\"fa fa-edit\"></i>\n                </a>&nbsp;<a title=\"Delete\" class=\"btn btn-sm delete-btn\" data-id=\"").concat(row.id, "\" href=\"#\">\n           <i class=\"fa-solid fa-trash\"></i>\n                </a></div>");
      },
      name: 'id'
    }]
  });
  $(document).on('click', '.delete-btn', function (event) {
    var instituteId = $(event.currentTarget).attr('data-id');
    deleteItem(instituteUrl + '/' + instituteId, tableName, 'Institute');
  });
});
/******/ })()
;