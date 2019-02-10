<?php

namespace app\apis\model\service;
class UserChangeModel 
{
    /* name:初始化函数
     * purpose: 服务层模型初始化方法,初始化逻辑层类对象.
     * return:  无
     * author:longdada
     * write_time:2019/01/30 14:50
     */
    public function __construct()
    {
        $this->user_change=model('logic.UserChange');
    }
    /* name:账户余额充值
     * purpose: 保存会员账户余额充值
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/02/10 09:55
     */
    public function save_user_money_add()
    {
        return $this->user_change->save_user_money_add();
    }
    /* name:充值支付确认
     * purpose: 充值支付成功更新用户余额
     * return:  返回更新结果
     * author:longdada
     * write_time:2019/02/10 10:55
     */
    public function save_user_money_confirm()
    {
        return $this->user_change->save_user_money_confirm();
    }
}
