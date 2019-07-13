+++
date = "2019-07-13T10:00:36+08:00"

tags = []
title = "window下vagrant 搭建flutter开发环境"

+++

## fluter 在 vagrant 下环境搭建

由于在工作中使用vagrant 开发，学习flutter时候，也希望能在vagrant下开发调试，经过大半夜折腾，于是有了这篇记录

| 系统环境          |     win10        |
|------------------|------------------|
|vagrant           |2.2.4             |
|virtualbox        | 6.0.8            |
|vm                |debian9           |


### 安装步骤

####  安装flutter

官网下载

```
 mkdir -p ~/bin/flutter
 cd ~/bin/flutter
 wget https://storage.googleapis.com/flutter_infra/releases/stable/linux/flutter_linux_v1.7.8+hotfix.3-stable.tar.xz
 tar xf ~/Downloads/flutter_linux_v1.7.8+hotfix.3-stable.tar.xz
 echo "export PATH:$PATH:/home/vagrant/bin/flutter/flutter/bin" >> ~/.profile
 source ~/.profile

```

这一步，flutter,安装成功，运行 which flutter ，正常显示如下

```
/home/vagrant/bin/flutter/flutter/bin/flutter

```
#### 安装 oracle java jdk8

这次需要打开浏览器，登录验证，下载
下载地址为 [jdk-8u211-linux-x64.tar.gz](https://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html)

下载完成后复制到vagrant 虚拟机目录

```
mkdir -p ~/bin/java/sdk
mv ~/path/jdk-8u211-linux-x64.tar.gz ~/bin/java/sdk
tar zxvf jdk*
```

下面设置java 环境变量 nano ~/.profile

```
## java jdk8
export JAVA_HOME=/home/vagrant/bin/java/jdk1.8.0_211
export PATH="$PATH:$JAVA_HOME/bin"
export CLASSPATH="$JAVA_HOME/lib/"

```

保存， 执行命令 java -version ，显示如下表示安装成功

```

java version "1.8.0_211"
Java(TM) SE Runtime Environment (build 1.8.0_211-b12)
Java HotSpot(TM) 64-Bit Server VM (build 25.211-b12, mixed mode)

```

####  安装 android sdk

由于我们使用vscode编辑器，不使用 android studio IDE,所以单独安装sdk 就可以了

下载 [sdk manager](https://developer.android.com/studio)
仅下载 sdk command line tool 即可 下载完成，移动到bin/android/sdk文件夹，添加到path

```
## android sdk manager

export ANDROID_HOME=/home/vagrant/bin/android/sdk/sdk
export PATH="$PATH:$ANDROID_HOME/tools/bin"
```


通过上面安装步骤，我们应该已经完成sdkmanager

下面我们需要安装开发android 必备packages

Path                 | Version | Description                    | Location             
  -------              | ------- | -------                        | -------              
  build-tools;28.0.3   | 28.0.3  | Android SDK Build-Tools 28.0.3 | build-tools/28.0.3/  
  build-tools;29.0.1   | 29.0.1  | Android SDK Build-Tools 29.0.1 | build-tools/29.0.1/  
  platform-tools       | 29.0.1  | Android SDK Platform-Tools     | platform-tools/      
  platforms;android-28 | 6       | Android SDK Platform 28        | platforms/android-28/
  sources;android-28   | 1       | Sources for Android 28         | sources/android-28/  
  tools                | 26.1.1  | Android SDK Tools 26.1.1       | tools/


#### 安装gradle

  这个可以通过[sdkman](https://sdkman.io/)命令安装,基本上安装官网教程走就可以

  ```
$ curl -s "https://get.sdkman.io" | bash
$ source "$HOME/.sdkman/bin/sdkman-init.sh"
$ sdk install gradle 5.5.1


  ```


### virtualbox usb 配置

  ```
  # Enable USB Controller on VirtualBox
    config.vm.provider "virtualbox" do |vb|
      vb.customize ["modifyvm", :id, "--usb", "on"]
      vb.customize ["modifyvm", :id, "--usbehci", "on"]
    end

    # Implement determined configuration attributes
    config.vm.provider "virtualbox" do |vb|
      vb.customize ["usbfilter", "add", "0",
          "--target", :id,
          "--name", "Any Cruzer Glide",
          "--product", "Cruzer Glide"]
    end
  ```

  将上面的配置添加到你的Vagrantfile中， 运行vagrant reload

  如果提示错误，需要安装一下virtualbox usb exten pack，直接官网下载即可，然后再次重启vm


  这时候我们进入vm，手机连上usb，开启开发者模式执行下面命令

  ```
lsusb
  ```

正常就会显示如下

```
Bus 001 Device 002: ID 12d1:107e Huawei Technologies Co., Ltd. 
Bus 001 Device 001: ID 1d6b:0002 Linux Foundation 2.0 root hub
Bus 002 Device 001: ID 1d6b:0001 Linux Foundation 1.1 root hub
```

如果提示找不到lsusb,直接sudo apt install usbutils 即可
  
基本上，到这一步，我们的环境搭建基本就完成了，最后最重要的一步，就是配置 flutter的proxy，原因就是因为
pub get  如果配置代理，基本上卡住不动(proxy 直接设置http_proxy,https_proxy,no_proxy环境变量即可)

下面，是最终的flutter doctor -v

```
[✓] Flutter (Channel stable, v1.7.8+hotfix.3, on Linux, locale en_US.UTF-8)
    • Flutter version 1.7.8+hotfix.3 at /home/vagrant/bin/flutter/flutter
    • Framework revision b712a172f9 (3 days ago), 2019-07-09 13:14:38 -0700
    • Engine revision 54ad777fd2
    • Dart version 2.4.0

 
[✓] Android toolchain - develop for Android devices (Android SDK version 28.0.3)
    • Android SDK at /home/vagrant/bin/android/sdk/sdk
    • Android NDK location not configured (optional; useful for native profiling support)
    • Platform android-28, build-tools 28.0.3
    • ANDROID_HOME = /home/vagrant/bin/android/sdk/sdk
    • Java binary at: /home/vagrant/bin/java/jdk1.8.0_211/bin/java
    • Java version Java(TM) SE Runtime Environment (build 1.8.0_211-b12)
    • All Android licenses accepted.

[!] Android Studio (not installed)
    • Android Studio not found; download from https://developer.android.com/studio/index.html
      (or visit https://flutter.dev/setup/#android-setup for detailed instructions).

[✓] Proxy Configuration
    • HTTP_PROXY is set
    • NO_PROXY is localhost,127.0.0.1
    • NO_PROXY contains 127.0.0.1
    • NO_PROXY contains localhost

[✓] Connected device (1 available)
    • HMA AL00 • HJS5T18A19009977 • android-arm64 • Android 9 (API 28)

! Doctor found issues in 1 category.
```

### 运行demo


现在我们直接clone flutter 在github的仓库，进入exmaples，找几个demo，执行flutter run 就可以生成apk 文件并安装到手机上进行测试了

:)!


### 参考链接

- [flutter](https://flutter.dev/)
- [oracle java jdk8](https://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html)
- [android-sdk](https://developer.android.com/studio)
- [gradle](https://gradle.org/)
- [vagrant](https://www.vagrantup.com/)
- [virtualbox](https://www.virtualbox.org/)





