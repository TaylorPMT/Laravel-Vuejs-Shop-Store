CKEDITOR.dialog.add('categoryDialog', function(editor) {
    return {
        title: 'Thêm loại sản phẩm vào bài viết',
        minWidth: 400,
        minHeight: 200,
        contents: [{
            id: 'tab-basic',
            label: 'SKU Loại sản phẩm',
            elements: [{
                type: "text",
                id: 'category',
                label: 'SKU loại sản phẩm',
                validate: CKEDITOR.dialog.validate.notEmpty("Cần nhập SKU loại sản phẩm."),
            }, {
                type: "text",
                id: 'category_quatity',
                label: 'Số lượng hiển thị',
                validate: CKEDITOR.dialog.validate.notEmpty("Cần nhập số lượng."),
            }]
        }],
        onOk: function() {
            var dialog = this;
            var category = editor.document.createElement('div');
            category.setHtml('[category-item sku="' + dialog.getValueOf('tab-basic', 'category') + '" quantity="' + dialog.getValueOf('tab-basic', 'category_quatity') + '"]');
            editor.insertElement(category);
        }
    };
});