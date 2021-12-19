<template>
    <div class="form-group">
        <label v-if="!displayLabel">
            {{ nameLabel }}:
            <span class="text-danger" v-if="status">*</span>
        </label>
        <div class="form-select" :id="`format-${id}`">
            <div class="select">
                <select2-multiple-control
                    :options="options"
                    :id="`${id}`"
                    :settings="settings"
                    v-model="selectVal"
                    @select="$emit('select', $event)"
                    @change="$emit('change', $event)"
                    :disabled="disabled"
                ></select2-multiple-control>
            </div>
        </div>
        <span class="text-danger" :class="`msg-error-${id}`"></span>
    </div>
</template>

<script>
import Select2MultipleControl from 'v-select2-multiple-component';

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
            type: [String, Number, Array],
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
        Select2MultipleControl
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
        }
    }
}
</script>

<style>
</style>
