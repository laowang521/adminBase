<?php
namespace app\apis\model\logic;
class UserFeedbackModel
{
    /* name:逻辑层初始化方法
     * purpose: 初始化数据库层管理员模型对象
     * return:  无
     * author:longdada
     * write_time:2019/01/22 22:00
     */
    public function __construct()
    {
        $this->user_feedback=model('db.UserFeedback');
        $this->validates=validate('UserFeedback');
    }
    /* name:保存建议反馈
     * purpose: 保存建议反馈
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/02/08 21:17
     */
    public function save_feedback()
    {
        $post_data=input();
        if($this->validates->scene('save_feedback')->check($post_data)){  
            $post_data['status']=1;
            $rs_st=$this->user_feedback->allowField(true)->isUpdate(false)->save($post_data);
            if($rs_st!==false){
                $rs_arr['code']=1;
                $rs_arr['msg']=lang("SUB_SUCCESS");
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("SUB_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
}
