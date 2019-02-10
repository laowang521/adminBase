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
            $user_row=model('service.User')->get_user_row($post_data['user_id']);
            if($user_row['code']!=1){
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("NOT_USER_INFO");
            }else{
                $in_data['user_id']=$post_data['user_id'];
                $in_data['type']=1;
                $in_data['title']=lang('RECHARGE');
                $in_data['change_type']=1;
                $in_data['change_money']=$post_data['change_money'];
                $in_data['acc_type']=$post_data['acc_type'];
                $in_data['status']=0;
                $in_data['money']=$user_row['data']['user_money'];
                $in_data['next_money']=$user_row['data']['user_money']+$post_data['change_money'];
                $rs_st=$this->user_change->allowField(true)->isUpdate(false)->save($in_data);
                if($rs_st!==false){
                    $rs_arr['code']=1;
                    $rs_arr['data']=$this->user_change->id;
                    $rs_arr['msg']=lang("SUB_SUCCESS");
                }else{
                    $rs_arr['code']=0;
                    $rs_arr['msg']=lang("SUB_ERROR");
                }
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
                $up_change_data['id']=$rs_row['id'];
                $up_change_data['status']=1;
                $this->user_change->allowField(true)->isUpdate(true)->save($up_change_data);//更新充值记录状态
                $user_row=model('service.user')->get_user_row($rs_row['user_id']);
                $up_user_data['id']=$user_row['data']['id'];
                $up_user_data['user_money']=$user_row['data']['user_money']+$rs_row['change_money'];
                model('service.user')->save_user_update($up_user_data);//更新用户余额
                $rs_arr['code']=1;
                $rs_arr['data']=lang("SAVE_SUCCESS");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:提现申请
     * purpose: 保存用户提现申请
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/02/10 18:55
     */
    public function save_user_money_withdraw()
    {
        $post_data=input();
        if($this->validates->scene('save_user_money_withdraw')->check($post_data)){
            $user_row=model('service.User')->get_user_row($post_data['user_id']);
            if($user_row['code']!=1){
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("NOT_USER_INFO");
            }else{
                if($user_row['data']['user_money']>$post_data['change_money']){
                    $post_data['type']=1;
                    $post_data['title']=lang('WITHDRAW');
                    $post_data['change_type']=2;
                    $post_data['status']=0;
                    $post_data['money']=$user_row['data']['user_money'];
                    $post_data['next_money']=$user_row['data']['user_money']-$post_data['change_money'];
                    $rs_st=$this->user_change->allowField(true)->isUpdate(false)->save($post_data);
                    if($rs_st!==false){
                        $up_user_data['id']=$user_row['data']['id'];
                        $up_user_data['user_money']=$post_data['next_money'];
                        $up_user_data['freeze_money']=$user_row['data']['freeze_money']+$post_data['change_money'];
                        model('service.user')->save_user_update($up_user_data);
                        $rs_arr['code']=1;
                        $rs_arr['msg']=lang("SUB_SUCCESS");
                    }else{
                        $rs_arr['code']=0;
                        $rs_arr['msg']=lang("SUB_ERROR");
                    }
                }else{
                    $rs_arr['code']=0;
                    $rs_arr['msg']=lang("NOT_WITHDRAW");
                }
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:账户余额明细
     * purpose: 获取余额明细列表
     * return:  返回列表数据结果
     * author:longdada
     * write_time:2019/02/10 20:05
     */
    public function get_user_money_log()
    {
        $post_data=input();
        if($this->validates->scene('get_user_money_log')->check($post_data)){
            $post_data['start']=isset($post_data['start'])&&!empty($post_data['start'])?$post_data['start']:0;
            $post_data['page_size']=isset($post_data['page_size'])&&!empty($post_data['page_size'])?$post_data['page_size']:6;
            $where['user_id']=$post_data['user_id'];
            $where['type']=1;
            $rs_list=$this->user_change->where($where)->limit($post_data['start'],$post_data['page_size'])->order('id','desc')->select();
            if(!empty($rs_list)){
                foreach($rs_list as &$ve){
                    if($ve['next_money']>$ve['money']){
                        $ve['tag']='+';
                    }else{
                        $ve['tag']='-';
                    }
                }
                $rs_arr['code']=1;
                $rs_arr['msg']=lang("GET_SUCCESS");
                $rs_arr['count']=$this->user_change->where($where)->count();
                $rs_arr['start']=$post_data['start'];
                $rs_arr['page_size']=$post_data['page_size'];
                $rs_arr['data']=$rs_list;
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("GET_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:账户积分明细
     * purpose: 获取积分明细列表
     * return:  返回列表数据结果
     * author:longdada
     * write_time:2019/02/10 20:05
     */
    public function get_user_score_log()
    {
        $post_data=input();
        if($this->validates->scene('get_user_score_log')->check($post_data)){
            $post_data['start']=isset($post_data['start'])&&!empty($post_data['start'])?$post_data['start']:0;
            $post_data['page_size']=isset($post_data['page_size'])&&!empty($post_data['page_size'])?$post_data['page_size']:6;
            $where['user_id']=$post_data['user_id'];
            $where['type']=2;
            $rs_list=$this->user_change->where($where)->limit($post_data['start'],$post_data['page_size'])->order('id','desc')->select();
            if(!empty($rs_list)){
                foreach($rs_list as &$ve){
                    if($ve['next_money']>$ve['money']){
                        $ve['tag']='+';
                    }else{
                        $ve['tag']='-';
                    }
                }
                $rs_arr['code']=1;
                $rs_arr['msg']=lang("GET_SUCCESS");
                $rs_arr['count']=$this->user_change->where($where)->count();
                $rs_arr['start']=$post_data['start'];
                $rs_arr['page_size']=$post_data['page_size'];
                $rs_arr['data']=$rs_list;
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("GET_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
}
