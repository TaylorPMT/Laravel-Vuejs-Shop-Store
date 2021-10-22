<template>
    <div  class="content">
        <div class="container" style="margin-top:10%">
            <div class="row">
                <div class="col-md-12" id="login">
                    <form
                        action=""
                        autocomplete="off"
                        method="post"
                        @submit.prevent="login"
                    >
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="iconn">
                                    <i class="glyphicon glyphicon-user"></i
                                ></span>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="text1"
                                    v-model="form.name"
                                    name="name"
                                    placeholder="Tài khoản"
                                    required
                                />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="iconn1">
                                    <i class="glyphicon glyphicon-lock"></i
                                ></span>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="text2"
                                    v-model="form.password"
                                    name="password"
                                    placeholder="Mật khẩu"
                                    required
                                />
                            </div>
                        </div>
                        <div class="form-group">
                            <div
                                style="margin-top:50px;"
                                class="d-flex justify-content-center"
                            >
                                <button
                                    type="submit"
                                    class="btn btn-success"
                                    style="border-radius:30px;"
                                    @click.stop.prevent="handleLogin"
                                >
                                    Đăng Nhập
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { callAxios } from "../../../axios/callAxios";
import { mapState } from "vuex";
export default {
    data: () => ({
        form: {
            name: "",
            password: "",
            remember_me: false
        }
    }),
    computed: {
        ...mapState({})
    },
    methods: {
        async handleLogin() {
            let vm = this;
            let form = vm.form;

            if (form.name === "" || form.password === "") {
                this.$store.commit("SET_SHOW_POPUP", {
                    key: "danger",
                    text: "Vui lòng nhập mật khẩu"
                });
            } else {
                let res = await vm.$store.dispatch("loginUser", form);
                if (res.data.error == null && res.data.response_code == 200) {
                    localStorage.setItem(
                        "access_token",
                        "Bearer " + res.data.data.token
                    );
                    this.$store.commit("SET_SHOW_POPUP", {
                        key: "success",
                        text: "Đăng nhập thành công"
                    });
                    window.location.reload();
                }
            }
        }
    }
};
</script>
