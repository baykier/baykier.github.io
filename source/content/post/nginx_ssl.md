+++
date = "2017-08-29T05:23:25Z"
tags = ["nginx","openssl"]
title = "nginx ssl 证书配置"

+++

## nginx ssl证书配置

一般在开发环境中，ssl时没有必要设置的，但是因为测试需要用到https环境，所以就记录下来，当学习了。

### 生成ssl证书

https 需要证书，所需要的证书一般可以自己生成，这时候需要手动添加到浏览器，还有就是去证书网站申请,推荐使用
[Let's Encrypt](https://letsencrypt.org/) (注:这种证书只能使用3个月的时间，过期需要再次申请)
我们这里仅需要自己手动生成证书就可以了

1. 生成密钥key,执行下面的命令，输入两次密码就可以了

```
openssl genrsa -des3 -out dev.key 1024
```

2. 利用密钥key生成证书crt文件,执行下面的命令，输入证书的参数就可以了

```
openssl req -new -x509 -key dev.key -out dev.crt -days 3650
```

证书的参数:

- Country Name 国家名字 (CN 即可)
- State or Province Name 省或地区(BeiJing)
- Locality Name 当地地区 (BeiJing)
- Organization Name 机构名称 (develop Ltd)
- Organizational Unit Name 组织机构单位 (develop)
- Common Name 站点host (dev.com)
- Email Address 邮箱

3. 生成不需要密码的密钥,给nginx配置

```
openssl rsa -in dev.key -out dev.nopass.key
```

### 配置nginx

nginx 配置很简单，导入证书路径即可,下面是一个实例配置

```
server {
    listen 443;
    server_name dev.cn;

    ssl on;
    ssl_certificate /var/project/conf/nginx/dev.crt;
    ssl_certificate_key /var/project/conf/nginx/dev.nopass.key;

    root /var/project/htdocs/dev/public;

  	# Add index.php to the list if you are using PHP
  	index index.php index.html index.htm index.nginx-debian.html;

  	server_name dev.borrow.cn;

  	location / {
  		# First attempt to serve request as file, then
  		# as directory, then fall back to displaying a 404.
  		try_files $uri /index.php$is_args?$args ;
  	}

  	# pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
  	#
  	location ~ \.php {
  		include snippets/fastcgi-php.conf;

  	#	# With php7.0-cgi alone:
  	#	fastcgi_pass 127.0.0.1:9000;
  		# With php7.0-fpm:
  		fastcgi_pass unix:/run/php/php7.0-fpm.sock;
  	}

  	# deny access to .htaccess files, if Apache's document root
  	# concurs with nginx's one
  	#
  	#location ~ /\.ht {
  	#	deny all;
  	#}
  	access_log /var/project/log/nginx/dev.cn-access.log;
  	error_log /var/project/log/nginx/dev.cn-error.log;
 }
```

## 相关阅读

- [证书介绍](http://www.cnblogs.com/littlehann/p/3738141.html)
- [openssl、x509、crt、cer、key、csr、ssl、tls 这些都是什么鬼?](http://www.cnblogs.com/yjmyzz/p/openssl-tutorial.html)






