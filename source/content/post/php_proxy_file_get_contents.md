+++
date = "2017-06-21T01:42:02Z"
tags = ["php"]
title = "php file_get_contents() 函数代理设置"

+++

## php file_get_contents() 函数代理设置

### 遇到的问题

昨天在使用file_get_contents()函数抓取图片内容的时候，出现超时的情况，而且图片无法获取到
据猜测，是网络的问题，有可能被GFW河蟹了，于是登上我的服务器测试一下，发现在服务器可以正常打开。
所以想到了如何给file_get_contents()函数设置代理,记录下来

### file_get_contents()代理设置

下面摘自file_get_content()的[php官方手册](http://php.net/manual/en/function.file-get-contents.php)

```
string file_get_contents ( string $filename [, bool $use_include_path = false [, resource $context [, int $offset = 0 [, int $maxlen ]]]] )
```

其中，第三个参数**context**就是一个上下文资源参数，可以使用[stream_context_create()](http://php.net/manual/en/function.stream-context-create.php)
来创建

具体代码如下:

```
$context = stream_context_create(array(
	'http' => array(
		'proxy' => '[tcp|udp]<proxy ip>:<proxy port>',
		'request_fulluri' => true,
	),
));

//下面是简单的测试

$url = 'froyo.cc';
$content = file_get_contents($url,false,$context);
echo $content;

```

### 相关参考

使用strea_context_create()函数的库很多，比如[Guzzle](https://github.com/guzzle/guzzle)

1.[php stream](http://php.net/manual/zh/book.stream.php)

2.[理解php的流](https://www.oschina.net/translate/understanding-streams-in-php)