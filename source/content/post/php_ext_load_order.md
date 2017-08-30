+++
date = "2017-08-30T10:31:22Z"
tags = ["php","扩展"]
title = "php扩展模块加载顺序"

+++

## php扩展模块的加载顺序

### 为啥会有这个问题？

今天在安装php的扩展[apm](http://pecl.php.net/package/APM)的时候，文档写着必须在json扩展加载之后再加载apm模块,原文如下:

```
Activate the extension in the php configuration by adding:

extension=apm.so
Note: APM depends on JSON, so the apm.so extension must be loaded after JSON!
```

### 那么php的扩展加载顺序是怎么规定的?

按照php手册上面的说明，php扩展加载是写在php.ini文件中的，而php的配置文件是顺序解析的，这说明除了默认内核扩展，php的其他扩展模块
的加载顺序就是php.ini中的顺序，这是针对php.ini中的配置