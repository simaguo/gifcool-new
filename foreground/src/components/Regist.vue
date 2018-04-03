<template>
    <section class="regist-main">
        <div>
            <mt-field  placeholder="请输入邮箱" type="email" v-model="email" state="success"></mt-field>
            <mt-field  placeholder="请输入密码" type="password" v-model="password"></mt-field>
            <mt-field  placeholder="请输入密码" type="password" v-model="repassword"></mt-field>
        </div>

        <div class="regist-button">
            <mt-button type="primary" size="large">注册</mt-button>
        </div>
    </section>

</template>

<script type="application/javascript">
    export default {
        name:"Regist",
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
    .regist-main {
        margin: 10% 12px 0 12px;
    }
    .regist-button {
        margin-top: 40px;
    }
</style>