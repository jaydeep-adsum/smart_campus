/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/assets/js/student/student.js ***!
  \************************************************/
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
    columns: [{
      data: function data(row) {
        return "<div class=\"d-flex align-items-center\">\n                            <div class=\"mr-2\">\n                        <div class=\"\"><img src=\"".concat(row.image_url, "\" alt=\"\" class=\"user-img rounded-circle\" height=\"30px\" width=\"30px\"></div></div>\n                        <div class=\"d-flex flex-column\">").concat(row.first_name, " ").concat(row.last_name, "</a><span>").concat(row.email, "</span>\n                        </div></div>");
      },
      name: 'first_name'
    }, {
      data: 'institute_name',
      name: 'institute_name'
    }, {
      data: 'year',
      name: 'year'
    }, {
      data: 'semester',
      name: 'semester'
    }, {
      data: 'mobile_no',
      name: 'mobile_no'
    }, {
      data: function data(row) {
        return moment(row.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY');
      },
      name: 'created_at'
    }, {
      data: function data(row) {
        var url = studentUrl + '/' + row.id;
        return "<a title=\"Edit\" class=\"btn btn-sm edit-btn\" data-id=\"".concat(row.id, "\" href=\"").concat(url, "/edit\">\n            <i class=\"fa fa-edit\"></i>\n                </a>  <a title=\"Delete\" class=\"btn btn-sm delete-btn\" data-id=\"").concat(row.id, "\" href=\"").concat(url, "/delete\">\n           <i class=\"fa-solid fa-trash\"></i>\n                </a>");
      },
      name: 'id'
    }]
  });
  $("#searchbox").keyup(function () {
    tbl.fnFilter(this.value);
  });
});
/******/ })()
;