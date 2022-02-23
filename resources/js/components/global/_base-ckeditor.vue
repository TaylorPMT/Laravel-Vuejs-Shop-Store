<template>
    <div class="form-group">
        <label class="f-bold cl-black d-block">{{ label }}</label>
        <ckeditor
            class="form-control ckeditor-form"
            v-model="editorData"
            :config="editorConfig"
            :read-only="readonly"
            :editor-url="editorUrl"
        ></ckeditor>
    </div>
</template>

<script>
export default {
    props: {
        label: {
            type: String,
            default: "Nội dung"
        },
        value: {
            type: String,
            default: ""
        },
        readonly: {
            type: Boolean,
            default: false
        },
        placeholder: {
            type: String,
            default: ""
        },
        editorConfig: {
            type: Object,
            default: function () {
                return {
                    filebrowserBrowseUrl: "",
                    filebrowserUploadUrl: "",
                    filebrowserWindowWidth: "640",
                    filebrowserWindowHeight: "480",
                    language: "vi",
                    defaultLanguage: "vi",
                    skin: "moono-lisa",
                    extraPlugins: ["product", "category"],
                    removePlugins: ['divarea'],
                    editorplaceholder: "",
                    // enterMode: CKEDITOR.ENTER_BR,
                    toolbar: [
                        {
                            name: "document",
                            groups: ["mode", "document", "doctools"],
                            items: ["Source", "Table"]
                        },
                        {
                            name: "clipboard",
                            groups: ["clipboard", "undo"],
                            items: [
                                "Cut",
                                "Copy",
                                "Paste",
                                "PasteText",
                                "PasteFromWord",
                                "-",
                                "Undo",
                                "Redo"
                            ]
                        },

                        {
                            name: "basicstyles",
                            groups: ["basicstyles", "cleanup"],
                            items: ["Bold", "Italic", "Underline"]
                        },
                        {
                            name: "paragraph",
                            groups: [
                                "list",
                                "indent",
                                "blocks",
                                "align",
                                "bidi"
                            ],
                            items: [
                                "NumberedList",
                                "BulletedList",
                                "-",
                                "Indent",
                                "-",
                                "CreateDiv",
                                "JustifyCenter"
                            ]
                        },
                        { name: "links", items: ["Link", "Unlink"] },
                        {
                            name: "insert",
                            items: ["Image", "PageBreak", "Iframe"]
                        },

                        { name: "styles", items: ["Format"] },
                        { name: "tools", items: ["Maximize", "ShowBlocks"] },
                        { name: "colors", items: ["TextColor", "BGColor"] },
                        { name: "others", items: ["-"] },
                        { name: "product_new", items: ["Product"] },
                        { name: "category_new", items: ["Category"] },
                    ]
                };
            }
        }
    },
    data() {
        return {
            editorUrl: ""
        };
    },
    computed: {
        editorData: {
            get() {
                return this.value;
            },
            set(val) {
                this.$emit("input", val);
            }
        },
        Domain() {
            return DOMAIN;
        }
    },
    created() {
        let vm = this;
        vm.editorConfig.editorplaceholder = vm.placeholder;
        vm.editorUrl = vm.Domain + "/admins/CMS/plugins/ckeditor/ckeditor.js";
        vm.editorConfig.filebrowserBrowseUrl =
            vm.Domain + "/admins/CMS/plugins/ckfinder/ckfinder.html";
        vm.editorConfig.filebrowserUploadUrl =
            vm.Domain +
            "/admins/CMS/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files";
    }
};
</script>

<style>
.ckeditor-form {
    height: 100%;
}
.form-group {
    margin: 10px 0;
}
</style>
