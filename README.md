#### 前言
基于lumen+vue的完全前后端分离的spa项目demo

#### 下载

>git clone https://github.com/simaguo/gifcool-new.git

#### 演示地址
[www.gifcool.cn](https://www.gifcool.cn)

#### 关于后端部分

##### 技术栈
* php7.1
* composer
* lumen5.5
* dingo/api
* jwt

###### 安装依赖包及迁移数据
>cd path/to/gifcool-new/background/

>composer install

>php artisan migrate

###### 编辑.env
>copy .env.example .env

###### 设置目录软连接

>ln -s   path/to/gifcool-new/background/storage/app/avatar  path/to/gifcool-new/background/public/avatar

### 关于前端部分

##### 技术栈
* webpack
* vue
* vuex
* vue-router
* mint-ui

##### 项目运行

>cd path/to/gifcool-new/foreground/

>npm install (or cnpm install)

>npm run dev

##### 一些说明
可以在 api/index.js 中调整api的host