CKEDITOR.plugins.add('product', {
    icons: 'product',
    init: function(editor) {
        editor.addCommand('product', new CKEDITOR.dialogCommand('productDialog'));
        editor.ui.addButton('Product', {
            label: 'Thêm sản phẩm bài viết',
            command: 'product',
            toolbar: 'product_new'
        });
        CKEDITOR.dialog.add('productDialog', this.path + 'dialogs/product.js');
    }
});