<template>
    <div class="form-group">
        <label v-if="!displayLabel">
            {{ nameLabel }}:
            <span class="text-danger" v-if="status">*</span>
        </label>
        <div class="form-select" :id="`format-${id}`">
            <div class="select">
                <Select2
                    :options="options"
                    :id="`${id}`"
                    :settings="settings"
                    v-model="selectVal"
                    @select="$emit('select', $event)"
                    @change="$emit('change', $event)"
                    :disabled="disabled"
                ></Select2>
            </div>
        </div>
        <span class="text-danger" :class="`msg-error-${id}`"></span>
    </div>
</template>

<script>
import Select2 from 'v-select2-component';
export default {
    props: {
        status: {
            type: Boolean,
            default: false,
        },
        id: {
            type: String,
            default: ''
        },
        value: {
            type: [String, Number],
            default: ''
        },
        nameLabel: {
            type: String,
            default: '',
        },
        options: {
            type: [Array, Object],
            default: function () {
                return []
            }
        },
        displayLabel: {
            type: Boolean,
            default: false,
        },
        settings: {
            type: [Array, Object],
            default: function () {
                return {
                    placeholder: 'Chọn',
                }
            }
        },
        disabled: {
            type: Boolean,
            default: false
        }
    },
    components: {
        Select2
    },
    computed: {
        selectVal: {
            get() {
                return this.value;
            },
            set(val) {
                this.$emit('input', val)
            }
        }
    },
    watch: {
        selectVal(val) {
            let vm = this;
            let id = "format-" + vm.id;
            let msg_error = document.querySelector('.msg-error-' + vm.id);
            if (val != '') {
                vm.$root.getId(id).classList.remove('error');
                msg_error.innerHTML = ''
            }
        }
    }
}
</script>

<style>
</style>
