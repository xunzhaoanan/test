---
layout: post
title:  "网络游戏登录流程"
date:   2018-08-11 13:00:00
categories: 行业
tags: 游戏 登录
excerpt: 这篇文章简单说一下游戏行业通用的登录流程，因为游戏登录跟其他网站或APP的登录会有不同，会涉及到多方系统。
---


* content
{:toc}


这篇文章从发行商角度简单说一下网络游戏行业通用的登录流程，因为游戏登录跟其他网站或APP的登录会有不同，会涉及到多方系统。

## 简述

目前博主接触的游戏运作方式大部分是CP通过发行SDK对接第三方推广渠道，也可以通过发行自己推广，主要看发行商推广的实力。

* **CP** - 即内容提供商，对于游戏行业来说，主要是游戏开发商。
* **发行** - 即游戏发行商，具有游戏发行资格，负责游戏推广的厂商。
* **推广渠道** - 即具有很强推广能力的渠道商，比如应用宝，华为，UC等，一般发行会把游戏放在渠道市场供用户下载。

所以在游戏发行的时候，可能会存在多方，每一方都需要保留自己的用户数据去做结算用来分成等操作，所以这里就牵扯出了一个多账号问题。

## 登录流程

对于普通账号体系来说，登录无非就是保存用户的账号密码等数据，这份数据在本系统是唯一的，也就是说，一个账号对应的**id**只有一个。
但是在上述游戏发行的场景来说，一个账号会有多个不同系统的id，下面从发行SDK用户的角度来说明一下登录流程。

> 推广渠道SDK用户登录流程和发行SDK大同小异，但是前面有说过，发行SDK往往会对接推广渠道SDK，这时候发行SDK就是一个类似中间件的角色了。

### 发行直接推广

这种方式，发行SDK在对接好CP后，就可以直接对外推广发售了。所以用户的信息会分别在发行SDK和CP保存。

用户在注册游戏账号的时候，是注册发行公司的账号，这份数据是保存在发行的服务器上的，这时候会生成发行账号id，同时也会根据不同游戏生成一个游戏id。
账号id是用来在发行的SDK登录，而游戏id是需要传递给CP用来注册或者登录的。

有的人会问，那为什么不直接生成一个id一起用呢？这里涉及到业务上的一个问题 - 发行SDK会对接多个游戏。
所以有时候我们发现同一公司的多款游戏是可以用同一个账号的，这种情况我们的账号id是同一个，但是游戏id就是多个了。

有一点需要注意：在用户注册后，我们生成了发行的id和游戏id，这里还需要生成发行的**openid**。
这个openid是干嘛的呢？这个主要是用来CP服务器验签登录的，因为CP那边登录的时候只有游戏id，是没有账号密码的，只能通过发行的SDK来验证登录。

用户在登录游戏后，发行SDK会把游戏id和openid传递给CP服务器登录游戏，为了防止有人直接POST或者通过特殊手段更改游戏id登录其他账号，
CP服务器需要把这个openid经过约定的方式加密后，传回给发行SDK服务器验证。
发行SDK通过验证，就把openid相关联的游戏id返回到CP，CP再判断返回的游戏id是否和之前的一致就行了。

这种方式的登录还算比较简单，下面附一张发行直接推广登录时序图

![游戏登录时序图](https://i.loli.net/2019/03/15/5c8b188667be6.png)

### 接渠道商推广

如果游戏接了推广渠道商，推广渠道会把游戏上架到自己的应用市场（比如应用宝、小米市场等等），这时候就必须要对接推广渠道的SDK。
对接了渠道SDK的游戏包，我们一般称之为渠道包，当游戏被下载后，用户可以通过对应渠道的账号登录游戏。比如下载了应用宝渠道的包，
那我们就可以通过QQ或微信登录了；如果是小米的包，就可以用小米账号登录。

对于此场景，一般都是CP先对接聚合SDK（可以理解为发行SDK），然后又聚合SDK对接推广渠道。
为何CP不直接对接推广渠道呢？其实也是有的，但是不多，大部分会先对接聚合SDK，原因有两点：

1. CP可能没有发行权，无法直接在应用市场上架游戏。
2. CP的关注点在游戏本身质量，至于运营和推广可以交给发行。

前面说过在和CP对接登录时，会生成用户的发行账号id和游戏id，但是渠道包情况有所不同，因为用户登录输入的是渠道方的账号。
一般情况下，渠道SDK登录的时候会通过服务端验签，此时会把渠道账号id传参到游戏服务器来（这里的游戏服务器在本文中理解为发行SDK的服务器）。
这种情况，看起来会比较复杂，但是如果把这个渠道账号id其实理解为发行账号id一样的东西，那么就可以像之前一样处理登录了。
在数据中，建立一张账号id、游戏id和openid的关系表，即可解决。

> 其实渠道商SDK在对接的时候，是把对接方当做CP的，登录流程和发行商账号登录一样，需要有个登录验证过程，只是各个渠道商验证方式不一样罢了。

拿到了渠道商的账号id，用来生成游戏id和openid，就可以按照之前的流程登陆了。附一张接渠道商推广时序图：

![游戏登录时序图](https://i.loli.net/2019/03/15/5c8b4aed3ad7e.png)

## 结束语
作为发行SDK，此登录模式适合绝大部分场景。
对接CP不需要改代码，只要在后台添加参数配置；
对接第三方渠道，在代码中只需要添加一个渠道类，按照渠道文档验证登录即可，拿到渠道id后直接后直接调用公共方法登录。

到此结束，希望这些经验能帮助到有需要的朋友。

> 本文章系博主原创，如需转载，请注明出处。
