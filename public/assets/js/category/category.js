/******/
(() => { // webpackBootstrap
    var __webpack_exports__ = {};
    /*!**************************************************!*\
      !*** ./resources/assets/js/category/category.js ***!
      \**************************************************/
    $(document).ready(function () {
        var tableName = '#categoryTbl';
        var tbl = $(tableName).DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            ajax: {
                url: categoryUrl
            },
            columns: [{
                data: 'id',
                name: 'id'
            }, {
                data: 'name',
                name: 'name'
            }, {
                data: function data(row) {
                    return moment(row.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY');
                },
                name: 'created_at'
            }, {
                data: function data(row) {
                    return "<a title=\"Edit\" class=\"btn btn-sm edit-btn\" data-id=\"".concat(row.id, "\" href=\"#\">\n            <i class=\"fa fa-edit\"></i>\n                </a>  <a title=\"Delete\" class=\"btn btn-sm delete-btn\" data-id=\"").concat(row.id, "\" href=\"#\">\n           <i class=\"fa-solid fa-trash\"></i>\n                </a>");
                },
                name: 'id'
            }]
        });
        $(document).on('click', '.addCategoryModal', function () {
            $('#addCategoryModal').appendTo('body').modal('show');
        });
        $(document).on('submit', '#addCategoryForm', function (e) {
            e.preventDefault();
            $.ajax({
                url: categorySaveUrl,
                type: 'POST',
                data: $(this).serialize(),
                success: function success(result) {
                    if (result.success) {
                        displaySuccessMessage(result.message);
                        $('#addCategoryModal').modal('hide');
                        $(tableName).DataTable().ajax.reload(null, false);
                    }
                },
                error: function error(result) {
                    displayErrorMessage(result.responseJSON.message);
                }
            });
        });
        $(document).on('click', '.edit-btn', function (event) {
            var categoryId = $(event.currentTarget).attr('data-id');
            renderData(categoryId);
        });

        window.renderData = function (id) {
            $.ajax({
                url: categoryUrl + '/' + id + '/edit',
                type: 'GET',
                success: function success(result) {
                    if (result.success) {
                        $('#editCategory').val(result.data.name);
                        $('#categoryId').val(result.data.id);
                        $('#editCategoryModal').appendTo('body').modal('show');
                    }
                },
                error: function error(result) {
                    displayErrorMessage(result.responseJSON.message);
                }
            });
        };

        $(document).on('submit', '#editCategoryForm', function (e) {
            e.preventDefault();
            $.ajax({
                url: categoryUrl + '/update',
                type: 'POST',
                data: $(this).serialize(),
                success: function success(result) {
                    if (result.success) {
                        displaySuccessMessage(result.message);
                        $('#editCategoryModal').modal('hide');
                        $(tableName).DataTable().ajax.reload(null, false);
                    }
                },
                error: function error(result) {
                    displayErrorMessage(result.responseJSON.message);
                }
            });
        });
        $(document).on('click', '.delete-btn', function (event) {
            var categoryId = $(event.currentTarget).attr('data-id');
            deleteItem(categoryUrl + '/' + categoryId, tableName, 'Category');
        });
        $('#addCategoryModal').on('hidden.bs.modal', function () {
            $('#addCategoryForm')[0].reset();
        });
    });
    /******/
})()
;
