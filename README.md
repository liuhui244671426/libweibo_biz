# libweibo_biz
 
 新浪微博开放平台商业数据php sdk（Sina Weibo open platform business php sdk） 
 <a href="http://open.weibo.com" target="_blank">官网链接</a>

## composer 安装(推荐)
 composer 安装请参考,<a href="http://docs.phpcomposer.com/00-intro.html" target="_blank">链接</a>
 
 安装后编辑 composer.json 添加内容

<pre>
"require": {
    "liuhui/libweibo_biz":"dev-master"
}

"repositories": {
    "packagist": {
        "type": "composer",
        "url": "https://packagist.phpcomposer.com"
    }
},
"minimum-stability": "dev"
</pre>

 执行安装命令,进行安装

<pre>
composer install
</pre>

## 使用

<pre>
//在业务代码中加载 vender/autoload.php 文件

include 'vender/autoload.php';

添加相应的配置,如APPKEY,TOKEN 等,可以参考 tests/config.php 文件

//业务代码

echo "hello biz_weibo";

...
</pre>

##change log
添加收费 api

## 注意事项

<pre>此SDK 依赖 xiaosier/libweibo 包, <a href="https://github.com/xiaosier/libweibo">链接</a></pre>