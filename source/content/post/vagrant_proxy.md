+++
date = "2017-06-02T11:39:36+08:00"
tags = ["vagrant","proxy设置"]
title = "ubuntu 代理设置"

+++

# vagrant开发机代理设置

在学习工作中使用[vagrant](https://www.vagrantup.com/)作为开发环境已经有很长一段时间了，使用ubuntu
作为开发系统 在使用中发现，即使修改了apt的source.list源文件，在面对一些开发中需要的软件工具的时候，不可
避免的还是会遇到卡顿的问题，于是就查了一下资料，修改apt的proxy代理，来加快速度，最后又把git的也修改了

## apt git npm composer 等使用遇到的问题

apt git npm composer 由于GFW的存在，对于国内的程序员来说，经常卡住不动，无法使用，即使有镜像源，但由于存在
同步更新的问题，不能及时解决，所以需要进行proxy设置

## 设置proxy

1.git

```
	git config --global http.proxy <your proxy ip>:<your proxy port>
	git config --global https.proxy <your proxyip>:<your proxy port>
	
	# socks
	git config --global http.proxy socks5h://<your proxy ip>:<your proxy port>
	git config --global https.proxy socks5h://<your proxy ip>:<your proxy port>
```

参考[git proxy setting](https://gist.github.com/laispace/666dd7b27e9116faece6)

2.apt

```
 sudo echo 'Acquire::http::Proxy "http://<your proxy ip>:<your proxy port>";' >> /etc/apt/apt.conf
 sudo apt update 
 #下面可以体验飞一般的感觉了
 sudo apt install <some packages>
 ...
```

参考[apt proxy setting](https://askubuntu.com/questions/257290/configure-proxy-for-apt)

3.npm

```
 npm config set proxy http://<your proxy ip>:<your proxy port>
 npm config set proxy-https https://<your proxy ip>:<your proxy port>
```

参考[npm proxy setting](https://stackoverflow.com/questions/25660936/using-npm-behind-corporate-proxy-pac)

4.composer

方法一:

```
composer config -g repo.packagist composer https://packagist.phpcomposer.com
```

参考[composer中国镜像](https://pkg.phpcomposer.com/)

方法二:


```
export HTTP_PROXY=http://<your proxy ip>:<your proxy port>
export HTTPS_PROXY=http://<your proxy ip>:<your proxy port>
```
上面这种方法临时用一下，每次登录terminal之后需要重新设置，如果不想每次设置，可以保存在`~/.profile`中

```
echo "# proxy setting" >> ~/.profile
echo "export HTTP_PROXY='http://<your proxy ip>:<your proxy port>'" >> ~/.profile
echo "export HTTPS_PROXY='https://<your proxy ip>:<your proxy port>'" >> ~/.profile
source ~/.profile

```

## 实际效果

git npm apt composer 快了不是一点点 :) !



