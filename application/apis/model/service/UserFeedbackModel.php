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
}
