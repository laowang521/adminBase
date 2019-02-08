<?php

namespace app\apis\model\service;
class MsgModel 
{
    /* name:初始化函数
     * purpose: 系统模型初始化方法,初始化系统逻辑层类对象.
     * return:  无
     * author:longdada
     * write_time:2019/01/30 14:50
     */
    public function __construct()
    {
        $this->region=model('logic.Msg');
    }
}
