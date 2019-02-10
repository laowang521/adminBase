<?php

namespace app\apis\model\service;
class UserBrowseModel 
{
    /* name:初始化函数
     * purpose: 浏览记录模型初始化方法,初始化浏览记录逻辑层类对象.
     * return:  无
     * author:longdada
     * write_time:2019/01/30 14:50
     */
    public function __construct()
    {
        $this->user_browse=model('logic.UserBrowse');
    }
    /* name:我的浏览记录列表
     * purpose: 获取我浏览的店铺,商铺,文章,用户列表
     * return:  返回列表数据
     * author:longdada
     * write_time:2019/02/08 17:10
     */
    public function get_browse_list()
    {
        return $this->user_browse->get_browse_list();
    }
    /* name:添加浏览记录
     * purpose: 保存添加浏览记录
     * return:  返回浏览记录结果
     * author:longdada
     * write_time:2019/02/08 17:17
     */
    public function save_browse_add()
    {
        return $this->user_browse->save_browse_add();
    }
    /* name:取消浏览记录
     * purpose: 保存取消浏览记录
     * return:  返回取消浏览记录结果
     * author:longdada
     * write_time:2019/02/08 17:40
     */
    public function save_browse_del()
    {
        return $this->user_browse->save_browse_del();
    }
}
