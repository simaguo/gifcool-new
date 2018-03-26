<template>

    <section>
        <mt-navbar v-model="selected">
            <mt-tab-item id="x1">选项一</mt-tab-item>
            <mt-tab-item id="x2">选项二</mt-tab-item>
            <mt-tab-item id="x3">选项三</mt-tab-item>
        </mt-navbar>

        <!-- tab-container -->
        <mt-tab-container v-model="selected">
            <mt-tab-container-item id="x1">
                <article class="cont-li">
                    <div>
                        <header style="padding: 8px 16px;">标题</header>
                        <img style="width: 100%" :src="img"/>
                    </div>

                    <footer style="padding: 8px 16px;">
                        <span style="margin-right: 35px;"><icon  name="commenting"></icon>15</span>


                        <span style="margin-right: 5px;float: right"><icon name="thumbs-o-up"></icon>122</span>
                        <span style="margin-right: 15px;float: right"><icon name="thumbs-o-down"></icon>154</span>
                        <span style="margin-right: 25px;float: right"><icon  name="heart-o"></icon></span>

                    </footer>
                </article>
                <article class="cont-li">
                    <div>
                        <header style="padding: 8px 16px;">标题</header>
                        <img style="width: 100%" :src="img"/>
                    </div>

                    <footer style="padding: 8px 16px;">
                        <span>122! </span>
                        <span>154! </span>
                        <span>love </span>
                    </footer>
                </article>
                <article class="cont-li">
                    <div>
                        <header style="padding: 8px 16px;">标题</header>
                        <img style="width: 100%" :src="img"/>
                    </div>

                    <footer style="padding: 8px 16px;">
                        <span>122! </span>
                        <span>154! </span>
                        <span>love </span>
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
    export default {
        name: 'Index',
        data () {
            return {
                selected: 'x1',
                img: 'https://tse3.mm.bing.net/th?id=OIP.hT034blVsi-A1ChdKgQM9gHaE-&pid=Api',

            }
        }
    }
</script>
<style>
    image[lazy=loading] {
        width: 40px;
        height: 300px;
        margin: auto;
    }

    .cont-li {
        border-top: #666666 1px solid;
    }
</style>