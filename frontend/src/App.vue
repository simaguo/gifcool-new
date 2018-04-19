<template>
    <div>
        <section style="padding-bottom: 40px">
            <mt-header fixed title="gifcool">
                <router-link to="/" slot="left">
                    <mt-button icon="back">返回</mt-button>
                </router-link>
                <mt-button icon="more" slot="right" @click="more"></mt-button>
            </mt-header>

            <mt-actionsheet
                    :actions="actions"
                    v-model="sheetVisible">
            </mt-actionsheet>
        </section>


        <transition name="slide-fade">
            <router-view/>
        </transition>


        <section>
            <vue-core-image-upload
                    ref="avatar"
                    class="avatar-upload"
                    text=""
                    :url="url"
                    input-of-file="avatar"
                    extensions="jpg,png,jpeg"
                    crop="server"
                    :max-file-size="1048576"
                    input-accept="image/jpg,image/jpeg,image/png"
                    :isXhr="true"
                    :headers="headers"
                    :credentials="false"
                    @imageuploaded="imageuploaded" >
            </vue-core-image-upload>
        </section>


        <section style="padding-top: 55px;z-index:1">
            <mt-tabbar fixed v-model="selected">
                <mt-tab-item id="首页" href="#/">
                    <icon name="home" :scale="scale"></icon>
                    <br/>
                    首页
                </mt-tab-item>
                <mt-tab-item id="收藏" href="#/collection">
                    <icon name="bookmark-o" :scale="scale"></icon>
                    <br/>
                    收藏
                </mt-tab-item>
                <mt-tab-item id="发现" href="#/discover">
                    <icon name="compass" :scale="scale"></icon>
                    <br/>
                    发现
                </mt-tab-item>
                <!--<mt-tab-item id="我的" href="#/user">
                    <icon name="user-o" :scale="scale"></icon>
                    <br/>
                    我的
                </mt-tab-item>-->
            </mt-tabbar>
        </section>
    </div>
</template>



<script>
    import VueCoreImageUpload from 'vue-core-image-upload'
    import Api from '@/api'

    export default {
        name: 'App',
        components: {
            'vue-core-image-upload': VueCoreImageUpload,
        },
        data () {
            return {
                scale: 1.4,
                selected: '',
                sheetVisible: false,
                url:Api.getAvatarUploadUrl(),
                headers:{
                    "Authorization":'Bearer ' + this.$store.state.token
                }
            }
        },
        mounted: function () {
            let selected = '';
            if (this.$route.name == 'Index') {
                selected = '首页';
            } else if (this.$route.name == 'Collection') {
                selected = '收藏';
            } else if (this.$route.name == 'Discover') {
                selected = '发现';
            } else if (this.$route.name == 'User') {
                selected = '我的';
            }
            this.selected = selected;

        },
        computed: {
            actions: function () {
                let data = [];
                if (this.$store.state.token) {
                    data.push({
                        name: '退出',
                        method: this.toLogout
                    })
                    data.push({
                        name: '上传头像',
                        method: this.uploadAvatar
                    })
                } else {
                    data.push({
                        name: '登陆',
                        method: this.toLogin
                    })
                }
                return data;
            }
        },
        methods: {
            more: function () {
                this.$data.sheetVisible = !this.$data.sheetVisible
            },
            toLogin: function () {
                this.$router.push('login')
            },
            toLogout: function () {
                this.$store.dispatch('logout');
            },
            uploadAvatar: function () {
                try {
                    this.$refs.avatar.$input.click();
                } catch (error) {
                    console.log({'upload error': error})
                }

            },
            imageuploaded:function(){

            }
        }
    }
</script>

<style type="text/css">
    .slide-fade-enter-active {
        transition: all .3s ease-out;
    }

    .slide-fade-leave-active {
        transition: all .3s ease-out;
    }

    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active for below version 2.1.8 */
    {
        transform: translateX(10px);
        opacity: 0;
    }

    /*.upload-avatar input{
        display: none;
    }*/

    body, ol, ul, h1, h2, h3, h4, h5, h6, p, th, td, dl, dd, form, fieldset, legend, input, textarea, select {
        margin: 0;
        padding: 0
    }

    body {
        font: 12px "宋体", "Arial Narrow", HELVETICA;
        background: #ffffff;
        -webkit-text-size-adjust: 100%;
    }

    a {
        color: #2d374b;
        text-decoration: none
    }

    a:hover {
        color: #cd0200;
        text-decoration: underline
    }

    em {
        font-style: normal
    }

    li {
        list-style: none
    }

    img {
        border: 0;
        vertical-align: middle
    }

    table {
        border-collapse: collapse;
        border-spacing: 0
    }

    p {
        word-wrap: break-word
    }
</style>
