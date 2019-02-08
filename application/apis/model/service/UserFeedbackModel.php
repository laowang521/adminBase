<?php

namespace app\apis\model\service;
class UserFeedbackModel 
{
    /* name:初始化函数
     * purpose: 收藏模型初始化方法,初始化收藏逻辑层类对象.
     * return:  无
     * author:longdada
     * write_time:2019/01/30 14:50
     */
    public function __construct()
    {
        $this->user_feedback=model('logic.UserFeedback');
    }
    /* name:我的收藏列表
     * purpose: 获取我收藏的店铺,商铺,文章,用户列表
     * return:  返回列表数据
     * author:longdada
     * write_time:2019/02/08 17:10
     */
    public function get_collect_list()
    {
        return $this->user_collect->get_collect_list();
    }
    /* name:保存建议反馈
     * purpose: 保存建议反馈
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/02/08 21:17
     */
    public function save_feedback()
    {
        return $this->user_feedback->save_feedback();
    }
    /* name:取消收藏
     * purpose: 保存取消收藏
     * return:  返回取消收藏结果
     * author:longdada
     * write_time:2019/02/08 17:40
     */
    public function save_collect_del()
    {
        return $this->user_collect->save_collect_del();
    }
}
