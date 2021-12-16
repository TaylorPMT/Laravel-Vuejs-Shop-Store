<template>
    <div class="form-group">
        <label class="f-bold cl-black d-block" for="exampleFormControlSelect1">{{ label }}</label>
        <select
            class="form-control"
            data-style="btn btn-link"
            id="exampleFormControlSelect1"
            v-model="inputValue"
        >
            <option>Chọn {{ label }}</option>
            <option v-bind:value="option.id" v-for="(option, key) in options">{{ option.name }}</option>
        </select>
    </div>
</template>

<script>
export default {
    props: {
        options: {
            type: [Array, Object],
            default: function () {
                return []
            }
        },
        label: {
            type: String
        },
        value: {
            type: String
        },
        class_form: {
            type: String
        },
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
