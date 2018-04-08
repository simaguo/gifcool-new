<template>
    <section class="login-main">
        <div>
            <mt-field placeholder="请输入邮箱" type="email" v-model="email" state="success"></mt-field>
            <mt-field placeholder="请输入密码" type="password" v-model="password"></mt-field>
        </div>

        <div class="login-button">
            <mt-button type="primary" size="large" @click="login()">登录</mt-button>
            <div style="text-align: center;margin-top: 10px">
                还没有账号？马上去<a>注册</a>
            </div>
        </div>
    </section>

</template>

<script type="application/javascript">
    import Api from '../api';
    //import { Toast } from 'mint-ui';

    export default {
        name: "login",
        data () {
            return {
                email: "simaguo@qq.com",
                password: "123456",
            }
        },
        methods: {
            login: function () {
                let email = this.email;
                let password = this.password;
                let _this = this;
                Api.login(email,password).then(function (response) {
                    console.group(response)
                    let user = response.data.data
                    _this.$store.dispatch('login',user);
                    _this.$toast('登陆成功');
                    _this.$router.push({path:'/'});
                }).catch(function (error) {
                    _this.$toast('登陆失败');
                    if (error.response) {
                        // The request was made and the server responded with a status code
                        // that falls out of the range of 2xx
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);
                    } else if (error.request) {
                        // The request was made but no response was received
                        // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                        // http.ClientRequest in node.js
                        console.log(error.request);
                    } else {
                        // Something happened in setting up the request that triggered an Error
                        console.log('Error', error.message);
                    }
                    console.log(error.config);
                });
            }
        }
    }
</script>
<style>
    body {
        background-color: #f0f0f0;
    }

    .mint-cell {
        border-bottom: solid 1px #f7ecb5;
        border-radius: 24px;
        margin: 4px 0;
    }

    .login-main {
        margin: 10% 12px 0 12px;
    }

    .login-button {
        margin-top: 40px;
    }
</style>