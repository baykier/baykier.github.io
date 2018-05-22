+++
title = "mongodb如何在aggregate中进行distinct操作 "
tags = ["mongodb","distinct","aggregate"]
date = 2018-04-19
+++

## mongodb如何在aggregate中进行distinct操作

mongodb 在聚合操作中，经常需要同传统的sql一样，进行诸如 sum(distinct) ,group by having 操作，那么等价的mongodb是啥呢？

### 场景描述

现在需要用mongodb来记录业务员的外呼记录，使用三个表，结构分别如下：(实际情况可能有出入，抽出主要的字段说明)

- 业务员 admin_user

|字段 | 类型  |含义及说明   |
|-----|------|-------------|
|id   |int   |业务员id     |
|name |string|姓名         |

- 客户表 user

|字段 | 类型  |含义及说明   |
|-----|------|-------------|
|uid   |int   |客户id      |
|name |string|姓名         |

- 关联表 call_log

|字段 | 类型  |含义及说明    |
|-----|------|-------------|
|auid |int   |业务员id     |
|uid  |int   |客户id       |
|ctime|int   |呼叫时间     |


### 那么问题来了，如何找出具体某一天的业务员呼叫的客户数量？

这时候，如果简单的用mysql来处理，简单的一条sql就行了:

```
SELECT auid,COUNT(DISTINCT uid) AS call_count FROM call_log WHERE ctime >=<时间戳> AND ctime <= <时间戳> GROUP BY auid

```

但是用mongodb来处理，我找了半天，也没发现有distinct对等的函数，从stackoverflow上找到了答案，思路就是分两次组，第一次按auid，uid，第二次按auid，这样就会去重（一天可以呼叫同一个业务员多次)

代码如下:

```

db.campaigns.aggregate([
    { "$match": { "ctime": { "$gte": <时间戳>，"$lte":<时间戳> }}},
    { "$group": {
        "_id": {
            "auid": "$auid",
            "uid": "$uid"
        },
        "count": { "$sum": 1 }
    }},
    { "$group": {
        "_id": '$_id.auid',
        "count": { "$sum": 1 }
    }}
])


```

### 　参考链接

－　[mongodb group distinct](https://stackoverflow.com/questions/24761266/select-group-by-count-and-distinct-count-in-same-mongodb-query?utm_medium=organic&utm_source=google_rich_qa&utm_campaign=google_rich_qa)


