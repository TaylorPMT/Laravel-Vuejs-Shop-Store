export default {
    methods: {
        info(title, desc) {
            this.$Notice.info({
                title: title,
                desc: desc
            });
        },
        success(title, desc) {
            this.$Notice.success({
                title: title,
                desc: desc
            });
        },
        warning(title, desc) {
            this.$Notice.warning({
                title: title,
                desc: desc
            });
        },
        error(title, desc) {
            this.$Notice.error({
                title: title,
                desc: desc
            });
        },
        message() {
            return {
                confirm_delete: 'Bạn có muốn xóa không ? ',
                confirm_update: 'Bạn có muốn cập nhật không ?',
                success_update: 'Cập nhật thành công ',

            };
        }
    }
}