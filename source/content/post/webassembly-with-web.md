+++
title = "WebAssembly的发展与对web的影响"
tags = ["webassembly","web"]
date = 2018-03-02
+++

## WebAssembly的发展与对web的影响

WebAssembly或称wasm是一个实验性的低级编程语言，应用于浏览器内的客户端。WebAssembly是便携式的抽象语法树，被设计来提供比JavaScript更快速的编译及运行[2]。WebAssembly将让开发者能运用自己熟悉的编程语言（最初以C/C++作为实现目标）编译，再藉虚拟机引擎在浏览器内运行。WebAssembly的开发团队分别来自Mozilla、Google、Microsoft、Apple，代表着四大网络浏览器Firefox、Chrome、Microsoft Edge、Safari。2017年11月，所有以上四个浏览器都开始实验性的支持WebAssembly

简而言之，WebAssembly可以为C和C++编写的源码提供一个编译格式，使其能够运行在浏览器端，并暴露给JavaScript调用，这样一来，对于前端来说，将会引起巨大的变革,比如游戏,视频等等
具体请参考官方文档的介绍[WebAssembly的目标](https://developer.mozilla.org/zh-CN/docs/WebAssembly/Concepts#WebAssembly%E7%9A%84%E7%9B%AE%E6%A0%87)

### WebAssembly 目前浏览器支持


|浏览器      | 是否支持WebAssembly   |
|------------|----------------------|
|Chrome      |v                     |
|Firfox      |v                     |
|Edge        |v                     |
|Oprea       |v                     |
|Android     |v                     |
|Ios         |v                     |
|safari      |v                     |
|QQ浏览器     |v                     |
|Uc浏览器     |v                     |




据目前情况看，几乎所有的主流浏览器都已经支持WebAssembly，无论是PC上的Chrome,Firefox,Ie还是移动端的Uc,QQ浏览器(微信内核来自QQ浏览器内核，也支持),所以说WebAssembly的发展未来前途无量!

具体参考:

- [WebAssembly浏览器支持](https://developer.mozilla.org/zh-CN/docs/WebAssembly)

- [X5内核升级支持WebAssembly](https://x5.tencent.com/tbs/history.html#/detail/17)

- [U4 内核 WebGL 支持发展方向](https://zhuanlan.zhihu.com/p/28546930)

### WebAssembly 编程语言支持

目前完美支持WebAssembly的编程语言如下，相信未来会有更多的语言支持

- C

- C++

- Rust

- Lua


具体参考

[WebAssembly语言支持](https://github.com/appcypher/awesome-wasm-langs)

### 对Web的影响

目前最主要的编程方式的改变，未来C/C++肯定会在Web前端大放光彩,比如加密解密，视频压缩，裁剪等等，Web平台相应的应用范围得益于WebAssembly也会越来越广，在游戏领域会有更大的作为.

- 编程语言C/C++肯定爆发一波
- 前端开发会越来越重要，原生应用的开发者会面临很大的冲击

### 相关参考

- [awesome-WebAssembly](https://github.com/mbasso/awesome-wasm#languages)
- [http://webassembly.org/](http://webassembly.org/)