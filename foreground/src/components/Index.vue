<template>

    <section>
        <mt-navbar v-model="selected">
            <mt-tab-item id="x1">动图</mt-tab-item>
            <mt-tab-item id="x2">图文</mt-tab-item>
            <mt-tab-item id="x3">文章</mt-tab-item>
        </mt-navbar>

        <!-- tab-container -->
        <mt-tab-container v-model="selected">
            <mt-tab-container-item id="x1">
                <article class="cont-li" v-for="(value, key) in gifs">
                    <div>
                        <header style="padding: 8px 16px;"><router-link :to="{name:'Content',query:{id:value.id}}">{{ value.title }}</router-link></header>
                        <img style="" v-lazy="value.url" />
                    </div>

                    <footer style="padding: 8px 16px;">
                        <span style="margin-right: 35px;"><icon  name="commenting"></icon>{{ value.comments }}</span>
                        <span style="margin-right: 5px;float: right"><icon name="thumbs-o-up"></icon>{{ value.up }}</span>
                        <span style="margin-right: 15px;float: right"><icon name="thumbs-o-down"></icon>{{ value.down }}</span>
                        <span style="margin-right: 25px;float: right"><icon  name="heart-o"></icon></span>

                    </footer>
                </article>

            </mt-tab-container-item>
            <mt-tab-container-item id="x2">
                <mt-cell v-for="n in 4" :key="n" :title="'测试 ' + n"/>
            </mt-tab-container-item>
            <mt-tab-container-item id="x3">
                <mt-cell v-for="n in 6" :key="n" :title="'选项 ' + n"/>
            </mt-tab-container-item>
        </mt-tab-container>

    </section>


</template>

<script>
    import Api from '@/api'
    export default {
        name: 'Index',
        data () {
            return {
                selected: 'x1',
                img: 'https://tse3.mm.bing.net/th?id=OIP.hT034blVsi-A1ChdKgQM9gHaE-&pid=Api',
                gifs:[]
            }
        },
        methods:{
            load(){
                let _this = this;
                Api.gifs().then(function(response){
                    _this.gifs = response.data.data
                    console.group(_this.gifs)
                }).catch(function(error){
                    _this.$toast(error.response.data.message);
                });
            }
        },
        mounted:function(){
            this.load()
        }
    }
</script>
<style>
    image[lazy=loading] {
        height: 200px;
        width: 100%;
        /*width: 40px;
        height: 300px;
        margin: auto;*/
    }

    .cont-li {
        border-top: #666666 1px solid;
    }
</style>