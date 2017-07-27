# precautiontolog
 接口预警报告

# Installation

> composer require terrylucas/interfacelogs dev-master

1：使用composer安装之后 ,添加 ServiceProvider 到文件中 config/app.php 如下：

Laravel 5.x:

> \TerryLucasInterFaceLog\Logger\TerryLucasLoggerProvider::class,

2：使用composer安装之后 , 添加 Commands 到文件中  app\Console\Kernel.php 如下：

> TerryLucasInterFaceLog\Logger\Console\MakePreCommand::class, 

> TerryLucasInterFaceLog\Logger\Console\PreAnalysisCommand::class, 

> TerryLucasInterFaceLog\Logger\Console\PreAnalysisResCommand::class,

3：完成步骤1，2之后 可以直接按顺序执行以下命令 如下：

* 对应的配置文件，view文件其它必要的文件进行复制到开发项目中
>  php artisan make:pre

* 创建预警信息存储必备存储的表结构
>  php artisan migrate

* 日志文件读取分析存储数据库 
* 使用方式 设置定时任务 1分钟 间隔读取文件数据进行更新数据库表的信息
>  php artisan pre:log

* 获取数据库数据进行预警数据生成
* 使用方式 设置预警规则的平均值 天数 进行设置对应的定时任务时间 默认为7天
>  php artisan pre:res

4：项目中如何记录有效预警数据

* 方法 precordlog 接口参数说明
* 参数1 ： 项目中配置文件precaution设定的 precautiontags 的 uniqueid 值
* 参数2： 项目中需要存储的日志信息 数组形式
> app('preer')->precordlog('CA' , []);

5：如何查看预警情况 查看demo示例 访问路由

> 域名或者ip地址 + /terrylucas/pre

# License
MIT

         
         