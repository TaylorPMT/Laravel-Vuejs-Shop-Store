<template>
    <div class="form-group">
        <label class="f-bold cl-black d-block">{{ label }}</label>
        <textarea
            :class="class_form"
            v-model="value"
            :rows="row"
            :cols="cols"
        />
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
        rows: {
            type: Number
        },
        cols : {
            type : Number
        }
    }
};
</script>
