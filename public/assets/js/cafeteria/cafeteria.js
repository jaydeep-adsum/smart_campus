/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************************!*\
  !*** ./resources/assets/js/cafeteria/cafeteria.js ***!
  \****************************************************/
$(document).ready(function () {
  var tableName = '#cafeteriaTbl';
  var tbl = $(tableName).DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    // language: {
    //     processing: `<img src='${loaderUrl}'>`,
    // },
    ajax: {
      url: cafeteriaUrl
    },
    columnDefs: [{
      'targets': [4],
      'className': 'text-center',
      'orderable': false,
      'width': '8%'
    }],
    columns: [{
      data: function data(row) {
        return "<div class=\"d-flex align-items-center\">\n                            <div class=\"mr-2\">\n                        <div class=\"\"><img src=\"".concat(row.image_url, "\" alt=\"\" class=\"user-img rounded-circle\" height=\"30px\" width=\"30px\"></div></div>\n                        </div>");
      },
      name: 'id'
    }, {
      data: 'name',
      name: 'name'
    }, {
      data: 'price',
      name: 'price'
    }, {
      data: function data(row) {
        return row.category.name;
      },
      name: 'category'
    }, {
      data: function data(row) {
        var url = cafeteriaUrl + '/' + row.id;
        return "<div class=\"d-flex\"><a title=\"Edit\" class=\"btn btn-sm edit-btn\" data-id=\"".concat(row.id, "\" href=\"").concat(url, "/edit\">\n            <i class=\"fa fa-edit\"></i>\n                </a>&nbsp;<a title=\"Delete\" class=\"btn btn-sm delete-btn\" data-id=\"").concat(row.id, "\" href=\"#\">\n           <i class=\"fa-solid fa-trash\"></i>\n                </a></div>");
      },
      name: 'id'
    }]
  });
  $(document).on('click', '.delete-btn', function (event) {
    var cafeteriaId = $(event.currentTarget).attr('data-id');
    deleteItem(cafeteriaUrl + '/' + cafeteriaId, tableName, 'Cafeteria');
  });
});
/******/ })()
;