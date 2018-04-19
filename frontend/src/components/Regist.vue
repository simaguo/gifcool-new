<template>
    <section class="regist-main">
        <div>
            <mt-field  placeholder="请输入邮箱" type="email" v-model="email" ></mt-field>
            <mt-field  placeholder="请输入6-30个字符的用户名" type="name" v-model="name" ></mt-field>
            <mt-field  placeholder="请输入6-30个字符的密码" type="password" v-model="password"></mt-field>
            <mt-field  placeholder="请输入确认密码" type="password" v-model="repassword"></mt-field>
        </div>

        <div class="regist-button">
            <mt-button type="primary" size="large" @click="regist()">注册</mt-button>
        </div>
    </section>

</template>

<script type="application/javascript">
    import Api from '@/api'
    export default {
        name:"Regist",
        data () {
            return {
                email:"",
                name:"",
                password:"",
                repassword:"",
            }
        },
        methods:{
            regist(){
                let _this = this
                Api.regist(this.email,this.name,this.password,this.repassword).then(function(response){
                    let user = response.data.data
                    _this.$store.dispatch('regist',user);
                    _this.$toast('注册成功');
                    _this.$router.push({path:'/'});
                }).catch(function(error){
                    console.group(error.response.data)
                    for(var i in error.response.data.errors){
                        let message = error.response.data.errors[i][0];
                        console.log(message);
                        switch (i){
                            case 'email':{_this.email='';break;}
                            case 'name':{_this.name='';break;}
                            case 'password':{_this.password='';break;}
                            case 'repassword':{_this.repassword='';break;}
                        }
                        if(message != undefined){
                            _this.$toast(message);
                        }
                        break;

                    }

                })
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