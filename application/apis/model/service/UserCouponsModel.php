<?php

namespace app\apis\model\service;
class UserCouponsModel 
{
    /* name:初始化函数
     * purpose: 收藏模型初始化方法,初始化收藏逻辑层类对象.
     * return:  无
     * author:longdada
     * write_time:2019/01/30 14:50
     */
    public function __construct()
    {
        $this->user_coupons=model('logic.UserCoupons');
    }
    /* name:获取用户优惠券列表
     * purpose: 获取用户拥有的优惠券列表
     * return:  返回列表数据结果
     * author:longdada
     * write_time:2019/02/10 20:37
     */
    public function get_coupons_list()
    {
        return $this->user_coupons->get_coupons_list();
    }
}
