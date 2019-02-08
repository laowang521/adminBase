<?php

namespace app\apis\model\service;
class UserFollowModel 
{
    /* name:初始化函数
     * purpose: 系统模型初始化方法,初始化系统逻辑层类对象.
     * return:  无
     * author:longdada
     * write_time:2019/01/30 14:50
     */
    public function __construct()
    {
        $this->user_follow=model('logic.UserFollow');
    }
    /* name:我的关注列表
     * purpose: 获取我关注的店铺,商铺,文章,用户列表
     * return:  返回列表数据
     * author:longdada
     * write_time:2019/02/08 12:10
     */
    public function get_follow_list()
    {
        return $this->user_follow->get_follow_list();
    }
}
