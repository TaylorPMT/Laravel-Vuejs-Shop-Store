<template>
    <div class="form-group">
        <label class="f-bold cl-black d-block">{{ label }}</label>
        <input :class="class_form" :type="type" v-model="inputValue" />
    </div>
</template>
<script>
export default {
    props: {
        label: {
            type: String
        },
        value: {
            type: String
        },
        class_form: {
            type: String
        },
        type: {
            type: String,
            default: "text",
            validator(value) {
                return [
                    "email",
                    "number",
                    "password",
                    "search",
                    "tel",
                    "text",
                    "url"
                ].includes(value);
            }
        }
    },
    computed: {
        inputValue: {
            get() {
                return this.value;
            },
            set(val) {
                this.$emit("input", val);
            }
        }
    }
};
</script>
