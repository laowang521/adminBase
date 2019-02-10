<?php

namespace app\apis\model\service;
class CouponsModel 
{
    /* name:初始化函数
     * purpose: 收藏模型初始化方法,初始化收藏逻辑层类对象.
     * return:  无
     * author:longdada
     * write_time:2019/01/30 14:50
     */
    public function __construct()
    {
        $this->user_coupons=model('logic.Coupons');
    }
}
