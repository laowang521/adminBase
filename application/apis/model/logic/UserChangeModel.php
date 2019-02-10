<?php
namespace app\apis\model\logic;
class UserChangeModel
{
    /* name:逻辑层初始化方法
     * purpose: 初始化数据库层管理员模型对象
     * return:  无
     * author:longdada
     * write_time:2019/01/22 22:00
     */
    public function __construct()
    {
        $this->user_change=model('db.UserChange');
        $this->validates=validate('UserChange');
    }
    /* name:账户余额充值
     * purpose: 保存会员账户余额充值
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/02/10 09:55
     */
    public function save_user_money_add()
    {
        $post_data=input();
        if($this->validates->scene('save_user_money_add')->check($post_data)){
            $in_data['user_id']=$post_data['user_id'];
            $in_data['type']=1;
            $in_data['title']=lang('RECHARGE');
            $in_data['change_type']=1;
            $in_data['change_money']=$post_data['change_money'];
            $in_data['acc_type']=$post_data['acc_type'];
            $in_data['status']=0;
            $user_row=model('service.User')->get_user_row($post_data['user_id']);
            if($user_row['code']!=1){
                $in_data['money']=0;
                $in_data['next_money']=$post_data['change_money'];
            }else{
                $in_data['money']=$user_row['data']['user_money'];
                $in_data['next_money']=$user_row['data']['user_money']+$post_data['change_money'];
            }
            $rs_st=$this->user_change->allowField(true)->isUpdate(false)->save($in_data);
            if($rs_st!==false){
                $rs_arr['code']=1;
                $rs_arr['data']=$this->user_change->id;
                $rs_arr['msg']=lang("SAVE_SUCCESS");
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("SAVE_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:充值支付确认
     * purpose: 充值支付成功更新用户余额
     * return:  返回更新结果
     * author:longdada
     * write_time:2019/02/10 10:55
     */
    public function save_user_money_confirm()
    {
        $post_data=input();
        if($this->validates->scene('save_user_money_confirm')->check($post_data)){
            $where['id']=$post_data['id'];
            $where['status']=0;
            $rs_row=$this->user_change->where($where)->find();
            if(empty($rs_row)){
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("NOT_PAY_INFO");
            }else{

            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
}
