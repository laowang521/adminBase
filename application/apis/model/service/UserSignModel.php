<?php

namespace app\apis\model\service;
class UserSignModel 
{
    /* name:初始化函数
     * purpose: 收藏模型初始化方法,初始化收藏逻辑层类对象.
     * return:  无
     * author:longdada
     * write_time:2019/01/30 14:50
     */
    public function __construct()
    {
        $this->user_sign=model('logic.UserSign');
    }
    /* name:会员连续签到天数
     * purpose: 会员连续签到天数(获取签到天数)
     * return:  返回查询结果
     * author:longdada
     * write_time:2019/02/10 08:35
     */
    public function get_user_sign_count()
    {
        return $this->user_sign->get_user_sign_count();
    }
    /* name:会员签到
     * purpose: 保存会员签到记录
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/02/10 09:15
     */
    public function save_user_sign_add()
    {
        return $this->user_sign->save_user_sign_add();
    }
}
