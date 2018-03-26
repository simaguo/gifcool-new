<template>
    <section>
        <article class="content-up">
            <div class="content-up-main">
                <header>标题</header>
                <img :src="img"/>
            </div>

            <footer class="content-up-footer">
                <span class="content-up-footer-comment">
                    <icon name="commenting"></icon>15
                </span>
                <span class="content-up-footer-up">
                    <icon name="thumbs-o-up"></icon>122
                </span>
                <span class="content-up-footer-down">
                    <icon name="thumbs-o-down"></icon>154
                </span>
                <span class="content-up-footer-love">
                    <icon name="heart-o"></icon>
                </span>

            </footer>
        </article>
        <article class="content-center">
            <div class="content-center-header">
                    <span>
                        <icon name="edit"></icon>
                        写评论
                    </span>
            </div>
            <div class="content-center-text">
                <textarea placeholder="评论"></textarea>
            </div>
        </article>

        <article class="content-down">
            <h3>热门评论</h3>
            <div class="content-down-comments">
                <div><span class="content-down-comments-name">张三</span><span>3h</span></div>
                <div class="content-down-comments-text">
                    <p>听到砸门，西门庆为什么吓得魂不附体？因为武大郎此时有权在捉奸现场杀死西门庆和潘金莲，但必须同时杀掉两人。宝强几项条件完全具备，又有足够的武术技能实现其目的。早生一百二十年，就不用浪费国家那么多法律资源，宝强一人即可办妥 </p>
                </div>
            </div>
            <div class="content-down-comments">
                <div><span class="content-down-comments-name">张三</span><span>3h</span></div>
                <div class="content-down-comments-text">
                    <p>听到砸门，西门庆为什么吓得魂不附体？因为武大郎此时有权在捉奸现场杀死西门庆和潘金莲，但必须同时杀掉两人。宝强几项条件完全具备，又有足够的武术技能实现其目的。早生一百二十年，就不用浪费国家那么多法律资源，宝强一人即可办妥 </p>
                </div>
            </div>
            <div class="content-down-comments">
                <div><span class="content-down-comments-name">张三</span><span>3h</span></div>
                <div class="content-down-comments-text">
                    <p>听到砸门，西门庆为什么吓得魂不附体？因为武大郎此时有权在捉奸现场杀死西门庆和潘金莲，但必须同时杀掉两人。宝强几项条件完全具备，又有足够的武术技能实现其目的。早生一百二十年，就不用浪费国家那么多法律资源，宝强一人即可办妥 </p>
                </div>
            </div>
        </article>
    </section>

</template>

<script type="application/javascript">

    export default {
        name: "Content",
        data () {
            return {
                img: 'https://tse3.mm.bing.net/th?id=OIP.hT034blVsi-A1ChdKgQM9gHaE-&pid=Api',
            };
        }
    }


</script>

<style type="text/css">
    .content-up {
    }

    .content-up .content-up-main {
    }

    .content-up .content-up-main header {
        padding: 8px 16px;
    }

    .content-up .content-up-main img {
        width: 100%
    }

    .content-up .content-up-footer {
        padding: 8px 16px;
    }

    .content-up .content-up-footer .content-up-footer-comment {
        margin-right: 35px;
    }

    .content-up .content-up-footer .content-up-footer-up {
        margin-right: 5px;
        float: right
    }

    .content-up .content-up-footer .content-up-footer-down {
        margin-right: 15px;
        float: right
    }

    .content-up .content-up-footer .content-up-footer-love {
        margin-right: 25px;
        float: right
    }

    .content-center {

    }

    .content-center .content-center-header {
        height: 30px;
    }

    .content-center .content-center-header span {
        float: right;
        line-height: 30px;
        text-align: center;
        margin-right: 21px
    }

    .content-center .content-center-text {
        height: 120px;
        margin: 0px 12px
    }

    .content-center .content-center-text textarea {
        width: 100%;
        height: 100%;
        border: 1px solid #aaa;
    }

    .content-down {
        margin: 10px 12px 0 12px;
    }
    .content-down h3{
        border-bottom: 1px solid #ce3d3a;color: #ce3d3a;padding: 6px 0;
    }

    .content-down .content-down-comments{
        margin: 10px 0px;
        border: #aaa 1px solid;
    }

    .content-down .content-down-comments .content-down-comments-name{
        color: #a5a4a4;
    }
    .content-down .content-down-comments .content-down-comments-text p{
        text-indent:24px;
    }
</style>