export default {
    methods: {
        info (title,desc) {
            this.$Notice.info({
                title: title,
                desc: desc
            });
        },
        success (title,desc) {
            this.$Notice.success({
                title: title,
                desc: desc
            });
        },
        warning (title,desc) {
            this.$Notice.warning({
                title: title,
                desc: desc
            });
        },
        error (title,desc) {
            this.$Notice.error({
                title: title,
                desc: desc
            });
        }
    }
}
