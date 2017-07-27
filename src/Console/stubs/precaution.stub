<?php

return [

    //配置存储日志的服务器地址或者服务器地址列表
    //不是必须项
    /**
     *  [
     *      'serverip' => '127.0.0.1',//表示含义
     *      'uniqueid' => '127', //必须唯一
     *   ]
     */
    // 'hosts' => [
    //     [
    //         'serverip' => '127.0.0.1',
    //         'uniqueid' => '127',
    //     ]
    // ],

    //粒度 就是预警粒度 默认为 1分钟
    'granularity' => 1,

    // 配置预警标识 默认配置
    /**
     * [
     *      'uniqueid' => 'ca_success', //必须唯一
     *      'meaning' => '标识ca签署接口成功！', //表示含义
     * ]
     *
     */
    'precautiontags' => [
        [
            'uniqueid' => 'CASUCCESS',
            'meaning' => '标识ca签署接口成功！',
        ],
        [
            'uniqueid' => 'CASUCCESS12',
            'meaning' => '标识ca签署接口成功12！',
        ],
    ],

    //配置接口是否预警等级规则
    'rules' => [
        //配置A套规则
        'A' => [
            'avg' => 7, //avg 表示获取过去7天数据 取平均值进行判定 第8天接口预测情况
            'mingrade' => 20, //mingrade 最小等级 表示 接口预测情况在平均值的百分之20 则评价为 报警 则发送邮件
        ]
    ],

    'setrules' => 'A', //默认套餐A 可以进行设定自定义的key 作为套餐属性

    // 配置日志记录目录 默认storage/logs
    'storage' => 'logs',

];