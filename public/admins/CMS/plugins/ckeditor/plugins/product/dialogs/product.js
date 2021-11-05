CKEDITOR.dialog.add('productDialog', function (editor) {
    return {
        title: 'Thêm sản phẩm vào bài viết',
        minWidth: 400,
        minHeight: 200,
        contents: [
            {
                id: 'tab-basic',
                label: 'SKU sản phẩm',
                elements: [
                    {
                        type: "text",
                        id: 'product',
                        label: 'SKU sản phẩm',
                        validate: CKEDITOR.dialog.validate.notEmpty("Cần nhập SKU sản phẩm."),
                    }
                ]
            }
        ],
        onOk: function () {
            var dialog = this;
            var product = editor.document.createElement('div');
            product.setHtml('[product-item sku="' + dialog.getValueOf('tab-basic', 'product') + '"]');
            editor.insertElement(product);
        }
    };
});
