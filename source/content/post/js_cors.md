+++
date = "2017-09-11T08:50:38Z"
tags = ["js"]
title = "JavaScript跨域访问控制问题"

+++

## JavaScript跨域访问控制问题

### 问题描述

1. **情景一**由于公司的文件上传采用单独的文件服务器管理，把上传文件操作做了统一抽象，形成了一个API接口，不管是前端（包括APP），
   后端，采用文件上传时，均采用一个接口，重要的是文件上传API地址是单独的一台服务器。对于后端和APP端来说，还好
   ，但是对于前端（H5）来说，就存在跨域的请求问题

2. **情景二**作为前端开发(H5),本地搭建测试环境，（http://localhost），链接测试环境的接口(http://test.xxxxx.com),这时候，由于
   请求的也不是同一个服务器，也会存在跨域问题

### 什么是跨域访问

当一个资源从与该资源本身所在的服务器不同的域或端口请求一个资源时，资源会发起一个**跨域 HTTP 请求**

### 如何解决跨域请求问题

要解决跨域问题，有两种方式:

1. 配置服务器，添加允许的跨域访问域名，从而使浏览器正常接收ajax返回的数据
```
server {
		listen       80;
		server_name  test.com;
		location /{
			add_header 'Access-Control-Allow-Origin' 'http://a.com';
			add_header 'Access-Control-Allow-Credentials' 'true';
			add_header 'Access-Control-Allow-Methods' 'POST';
		}
}
```
2. 如果后端使用php，则可以在index.php入口文件简单修改:
```
// 指定允许其他域名访问
header('Access-Control-Allow-Origin:http:localhost');
header('Access-Control-Allow-Credentials:true');
// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
```

### 相关阅读

- [HTTP跨域访问控制](https://developer.mozilla.org/zh-CN/docs/Web/HTTP/Access_control_CORS)
- [PHP 解决 CORS 跨域问题](http://blog.w2fzu.com/2016/11/21/2016-11-21-PHP-CORS/)









