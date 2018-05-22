---
title: "windows 开发环境设置"
date: 2018-05-22T14:26:17+08:00
---

## windows 开发环境设置

作为一个web开发，已经有5年了，最近正好有空，将工作中的开发环境设置使用来记录下来，来分享一下。windows系统，来开发后端程序，往往需要克服很大问题，比如，文件大小写的问题，扩展不支持等等。而为了解决这个问题，借助vagrant，docker可以完美的解决这些问题，保证和线上代码一致的开发环境(包括mac，linux)

### 依赖的工具和软件

- [git for window](https://git-scm.com/)
- [virtualbox](https://www.virtualbox.org/)
- [vagrant ](https://www.vagrantup.com/)
- [visual studio code](https://code.visualstudio.com/)
- [navicat](https://www.navicat.com.cn/)
- [robomongo](https://github.com/Studio3T/robomongo)
- [shadowsocks](https://github.com/shadowsocks)

### 开发环境初始化

假设，我们新去了一家公司，领导给分配了一台电脑，但是不是苹果(mac)，我们就要开始苦逼的布置开发环境了


1. 安装git 

git for window 默认集成了 MinGW，可以执行简单的shell命令，我们看重的就是这个(可以通过设置环境变量，来代理)

2. 安装virtualbox，shadowsocks等需要的软件

安装shadowsocks，安装shadowsocks，安装shadowsocks，重要的事件说三遍。现在，开发的技术文档被墙的越来越严重了，基本上不会翻墙的开发者是没有前途的，安装翻墙代理，不仅仅是为了google，查看技术文档，有时候还是为了解决vagrant的插件，和node，php，go等扩展的问题(做一个开发好难~)

3. 安装vagrant 和插件

安装vagrant过程不多说，重要的是安装两个插件[Vagrant WinNFSd](https://github.com/winnfsd/vagrant-winnfsd) 和[vagrant-proxyconf](https://github.com/tmatilai/vagrant-proxyconf),安装之前，需要先设置代理参数，由于使用gitbash，所有需要先设置两个环境变量http_proxy和https_proxy

```

export http_proxy="http://127.0.0.1:1080"
export https_proxy="$http_proxy"

```
然后，再安装上面的两个插件，其中Vagrant WinNFSd是为了解决window大小写的问题，vagrant-proxyconf是为了解决apt代理的问题


到这一步，基本上就全部结束了差不多，好了，game  over

### 参考资料

- [如何在代理环境中使用vagrant](https://stackoverflow.com/questions/19872591/how-to-use-vagrant-in-a-proxy-environment?utm_medium=organic&utm_source=google_rich_qa&utm_campaign=google_rich_qa)
- [vagrant windows 大小写问题解决](https://baykier.github.io/post/vagrant-win-case-sensetive/)