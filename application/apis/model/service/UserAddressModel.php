<?php

namespace app\apis\model\service;
class UserAddressModel 
{
    /* name:初始化函数
     * purpose: 系统模型初始化方法,初始化系统逻辑层类对象.
     * return:  无
     * author:longdada
     * write_time:2019/01/30 14:50
     */
    public function __construct()
    {
        $this->address=model('logic.UserAddress');
    }
    /* name:获取收货地址列表
     * purpose: 根据用户ID获取用户列表
     * return:  返回列表数据
     * author:longdada
     * write_time:2019/02/02 08:29
     */
    public function get_address_list()
    {
        return  $this->address-> get_address_list();
    }
}
