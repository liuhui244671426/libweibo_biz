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
<pre>
1.搜索最近数据API <a href="http://open.weibo.com/wiki/Business_API文档#.E6.90.9C.E7.B4.A2.E6.9C.80.E8.BF.91.E6.95.B0.E6.8D.AE.EF.BC.88.E6.94.B6.E8.B4.B9.EF.BC.89">链接</a>

2.微博内容数据API <a href="http://open.weibo.com/wiki/Business_API文档#.E5.BE.AE.E5.8D.9A.E5.86.85.E5.AE.B9.E6.95.B0.E6.8D.AE.EF.BC.88.E6.94.B6.E8.B4.B9.EF.BC.89">链接</a>

3.检索历史全量数据API <a href="http://open.weibo.com/wiki/Business_API文档#.E6.A3.80.E7.B4.A2.E5.8E.86.E5.8F.B2.E5.85.A8.E9.87.8F.E6.95.B0.E6.8D.AE.EF.BC.88.E6.94.B6.E8.B4.B9.EF.BC.89">链接</a>

4.微博用户数据API <a href="http://open.weibo.com/wiki/Business_API文档#.E5.BE.AE.E5.8D.9A.E7.94.A8.E6.88.B7.E6.95.B0.E6.8D.AE.EF.BC.88.E5.85.8D.E8.B4.B9.EF.BC.89">链接</a>

5.订阅服务API <a href="http://open.weibo.com/wiki/订阅服务手册">链接</a>

</pre>

## 注意事项

<pre>此SDK 依赖 xiaosier/libweibo 包, <a href="https://github.com/xiaosier/libweibo">链接</a></pre>