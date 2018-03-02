+++
title = "vagrant windows 大小写问题解决"
tags = ["vagrant","case-sensetive"]
date = "2018-03-02"
+++

## vagrant windows 大小写问题解决

开发环境使用vagrant，以为这样能很好的解决开发中的坑，没想到还是中了不区分大小写的问题的坑，记录下来，防止踩坑

开发环境: host windwos 10
虚拟机: guest debian8
出现的问题： 工作中使用php开发的cli脚本，需要到线上服务器执行，本地写完了，执行后返回预期的结果，开开心心的到服务器一运行，发现居然没反应(ps 和框架的异常机制也有问题)，
找了半天才发现是文件大小写的问题，由于使用vagrant在linux环境开发，就没有意识到这一点（默哀三秒。。。）然后查找相关资料，才发现使用virtualbox 默认挂载的目录是不区文件分大小写的
在guest中同样也是不区分，最开始的解决思路就是看看php能不能解决这个问题（让php跨平台的支持文件大小写）后来发现php底层是依赖与操作系统的，php本身无法解决，于是重点来了：
如何让windows+virtualbox中的vagrant支持区分文件大小写


### vagrant在windows+virtualbox 支持文件区分大小写

要想让vagrant 在windows host中支持文件大小写，需求通过安装插件来支持:nfs

1. 打开cmd命令行或者git bash:

```
vagrant plugin install vagrant-winnfsd

```
等执行完成后进行下一步

2. 在Vagrantfile添加 挂载参数 type:"nfs"

```
config.vm.synced_folder "./project", "/project", type:"nfs"

```

3. 添加private_network支持(插件依赖 https://github.com/winnfsd/vagrant-winnfsd#activate-nfs-for-vagrant):

```
config.vm.network "private_network", type: "dhcp"

```

4. vagrant reload虚拟机

```
vagrant reload

```

### ok！ 到这一步，问题算是解决了，让我们愉快的玩耍吧 :)

### 相关链接

- https://github.com/winnfsd/vagrant-winnfsd#activate-nfs-for-vagrant

- https://stackoverflow.com/questions/26483867/how-to-handle-files-in-case-sensitive-way-in-vagrant-on-windows-host