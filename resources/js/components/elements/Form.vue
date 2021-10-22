<template>
    <div>
        <div class="container-fluid my-5">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group" v-for="(item,key) in formData" :key="key">
                        <label>{{item.label}}</label>
                        <template v-if="item.key == 'input'">
                            <input :class="item.class" :type="item.type" :value="item.value" :placeholder="item.placeholder"/>
                        </template>
                        <template v-else-if="item.key == 'textarea'">
                            <textarea :class="item.class" :placeholder="item.placeholder">  </textarea>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from "vuex";
export default {
  props: {
    formData: {
        require : true
    },
  },
  created() {},
  methods: {},
  data() {
    return {};
  },
  name: "Form",
};
</script>
