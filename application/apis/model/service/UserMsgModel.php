<?php

namespace app\apis\model\service;
class UserMsgModel 
{
    /* name:初始化函数
     * purpose: 系统模型初始化方法,初始化系统逻辑层类对象.
     * return:  无
     * author:longdada
     * write_time:2019/01/30 14:50
     */
    public function __construct()
    {
        $this->user_msg=model('logic.UserMsg');
    }
    /* name:获取系统消息列表
     * purpose: 获取系统消息列表
     * return:  返回返回列表记录
     * author:longdada
     * write_time:2019/02/08 10:20
     */
    public function get_system_msg_list()
    {
       return  $this->user_msg->get_system_msg_list();
    }
    /* name:获取系统消息详情
     * purpose: 获取某一条系统消息的详情
     * return:  返回返回列表记录
     * author:longdada
     * write_time:2019/02/08 10:20
     */
    public function get_system_msg_details()
    {
        return  $this->user_msg->get_system_msg_details();
    }
     /* name:系统消息删除
     * purpose: 系统消息单个或批量删除
     * return:  返回删除结果
     * author:longdada
     * write_time:2019/02/08 11:40
     */
    public function get_system_msg_del()
    {
        return  $this->user_msg->get_system_msg_del();
    }
}
