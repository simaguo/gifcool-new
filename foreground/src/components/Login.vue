<template>
    <section class="login-main">
        <div>
            <mt-field  placeholder="请输入邮箱" type="email" v-model="email" state="success"></mt-field>
            <mt-field  placeholder="请输入密码" type="password" v-model="password"></mt-field>
        </div>

        <div class="login-button">
            <mt-button type="primary" size="large">登录</mt-button>
        </div>
    </section>

</template>

<script type="application/javascript">
    export default {
        name:"ogin",
        data () {
            return {
                email:"",
                password:"",
                repassword:"",
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