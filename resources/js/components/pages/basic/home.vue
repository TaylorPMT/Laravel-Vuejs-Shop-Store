<template>
    <div  class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12" id="login">
                    <form
                        action=""
                        autocomplete="off"
                        method="post"
                        @submit.prevent="login"
                    >
                        <div class="logo">
                            <img
                                :src="asset('/frontend/assets/img/logo-main.jpg')"
                            />
                        </div>
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
                                class="d-flex justify-content-center"
                            >
                                <button
                                    type="submit"
                                    class="btn btn-success btn-primary"
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
import mixin from "../../../mix/mixin";
import { callAxios } from "../../../axios/callAxios";
import { mapState } from "vuex";
export default {
        mixins: [mixin],

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

<style lang="sass" scoped>
    .logo
        margin-bottom: 30px
        img
            width: 300px
            @media screen and (max-width: 768px)
                width: 250px
    .content
        text-align: center
        padding: 60px
        border: 1px solid var(--main-color)
        max-width: 500px
        margin: 0 auto
        transform: translateX(-30%)
        margin-top: 10%
        @media screen and (max-width: 768px)
            padding: 30px
            transform: translateX(0)
            margin-top: 30%
        .input-group input 
            border: 1px solid var(--main-color)
            padding: 10px
            height: 40px
            background: unset
            transition: .3s all
            &:hover,
            &:focus
                box-shadow: 0 0 6px rgba(#11706C, 0.8)
                transition: .3s all
</style>