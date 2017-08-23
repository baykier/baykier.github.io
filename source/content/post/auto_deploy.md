+++
tags = ["部署"]
title = "homepage 的自动部署"
date = "2017-06-05T10:00:36+08:00"

+++

# homepage自动部署

## 背景

首先交代一下背景，俺的博客是基于hugo的生成静态站点，代码放在github上面 对于[hugo](https://gohugo.io/)
和[github](https://github.com/)不是很了解的同学可以去了解一下。

下面是我写博客的大概流程:

1.在自己的个人电脑上写博客，用hugo生成静态站点测试无误后推送到github

```
# 新增博客
  hugo new post/<some_title>.md
# 用编辑器编辑并测试
  hugo server -w

# 生成静态站点
  hugo
#推送到github
  git push origin master
  
```

2.在服务器上面拉取更新站点

```
cd /path/to/site
git pull origin master
```

经过上面的分析可以看出，对于服务器端的每次拉取可以写成一个脚本，利用github的hook机制，这样每次写完博客
测试ok直接推送就行了，省去每次登录服务器，再`git pull`的操作，这样岂不美哉！

## 自动部署脚本原理

其实对于这个机智(偷懒)的想法早就有了，直到昨天下午有时间，才完善了一下。网上有很多类似的代码，实现原理
大同小异,都是根据github的hook机制,需要注意的就是安全方面，具体流程如下面:

1.博客更新推送到github

2.github推送webhook到url

3.url里面验证推送的来源(确保安全),执行代码拉取完成更新

## 编写php脚本(因为php是最好的语言么)

代码可以在这里找到[homepage自动部署脚本](https://github.com/baykier/homepage/blob/master/froyo.cc/public/index.php)

```
<?php
/**
 * homepage 自动更新脚本
 */

/**
 * CSV 软件 Git
 */
define('CSV_SOFT','git');
/**
 * HASH for github.com
 */
define('HASH','59341c1092c47');
define('ROOT_PATH',dirname(dirname(__DIR__)));
define('LOG_FILE',ROOT_PATH .'/git-auto-pull.log');

/**
 * 获取上次命令的状态
 * echo $?
 * @return int
 */
function getShellStatus()
{
    return (int) shell_exec(' echo @?');
}
$hash = isset($_GET['hash']) ? trim($_GET['hash']) : '';

if ($hash != HASH)
{
    header('HTTP/1.0 403 Forbidden');
    exit('Forbidden');
}

chdir(ROOT_PATH);
shell_exec(sprintf("echo git auto pull time is %s >> %s",date('Y-m-d H:i:s'),LOG_FILE));
shell_exec(sprintf("git pull origin master >> %s 2>&1 &",LOG_FILE));
shell_exec(sprintf("echo git pull status is %s >> %s \n",getShellStatus(),LOG_FILE));
?>
```

> 安装方面可以参考这里[CentOS 下利用 webhook 实现自动部署（PHP）](https://laravel-china.org/topics/2192/centos-under-the-use-of-webhook-to-achieve-automatic-deployment-php)

## 相关参考

1.如果需要部署项目，可能就需要用到自动部署工具了 php的有两个[deploy](https://deployer.org/)和[rocketeer](http://rocketeer.autopergamene.eu/)
它们都用到了git

2.[ansible](https://www.ansible.com/)不仅仅用于自动部署还用于管理集群

3.[webhooks](https://developer.github.com/webhooks/)github官方说明












