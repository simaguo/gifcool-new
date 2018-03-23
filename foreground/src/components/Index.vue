<template>
    <div>
        <mt-header title="标题过长会隐藏后面的内容啊哈哈哈哈">
            <router-link to="/" slot="left">
                <mt-button icon="back">返回</mt-button>
            </router-link>
            <mt-button icon="more" slot="right"></mt-button>
        </mt-header>

        <div>
            <ul>
                <li>
                    <mt-cell title="标题文字" is-link>
                        <span style="color: green"><img v-lazy="img"></span>
                    </mt-cell>
                </li>
                <li>
                    <mt-cell title="标题文字" is-link>
                        <span style="color: green"><img v-lazy="img"></span>
                    </mt-cell>
                </li>
            </ul>
        </div>
    </div>

</template>

<script>
    export default {
        name: 'Index',
        data () {
            return {
                img: 'http://fuss10.elemecdn.com/b/18/0678e57cb1b226c04888e7f244c20jpeg.jpeg'
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
</style>