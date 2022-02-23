CKEDITOR.plugins.add('category', {
    icons: 'category',
    init: function(editor) {
        editor.addCommand('category', new CKEDITOR.dialogCommand('categoryDialog'));
        editor.ui.addButton('Category', {
            label: 'Thêm loại sản phẩm',
            command: 'category',
            toolbar: 'category_new'
        });
        CKEDITOR.dialog.add('categoryDialog', this.path + 'dialogs/category.js');
    }
});