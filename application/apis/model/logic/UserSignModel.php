<?php
namespace app\apis\model\logic;
class UserSignModel
{
    /* name:逻辑层初始化方法
     * purpose: 初始化数据库层管理员模型对象
     * return:  无
     * author:longdada
     * write_time:2019/01/22 22:00
     */
    public function __construct()
    {
        $this->user_sign=model('db.UserSign');
        $this->validates=validate('UserSign');
    }
    /* name:会员连续签到天数
     * purpose: 会员连续签到天数(获取签到天数)
     * return:  返回查询结果
     * author:longdada
     * write_time:2019/02/10 08:35
     */
    public function get_user_sign_count()
    {
        $post_data=input();
        if($this->validates->scene('get_user_sign_count')->check($post_data)){
            $where['user_id']=$post_data['user_id'];
            $time=mktime(0,0,0,date("m"),date('d')-1,date("Y"));
            $where['add_time']=['egt',$time];
            $rs_row=$this->user_sign->where($where)->order('id','desc')->find();
            if(empty($rs_row)){
                $rs_arr['code']=1;
                $rs_arr['data']=0;
            }else{
                $rs_arr['code']=1;
                $rs_arr['data']=$rs_row['sign_continuity'];
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:会员签到
     * purpose: 保存会员签到记录
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/02/10 09:15
     */
    public function save_user_sign_add()
    {
        $post_data=input();
        if($this->validates->scene('save_user_sign_add')->check($post_data)){
            $where['user_id']=$post_data['user_id'];
            $time=mktime(0,0,0,date("m"),date('d'),date("Y"));
            $where['add_time']=['egt',$time];
            $rs_row=$this->user_sign->where($where)->order('id','desc')->find();
            if(!empty($rs_row)){
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("ALREADY_SIGN");
            }else{
                $start_time=$time=mktime(0,0,0,date("m"),date('d')-1,date("Y"));
                $end_time=$time=mktime(0,0,0,date("m"),date('d'),date("Y"));
                $where['user_id']=$post_data['user_id'];
                $where['add_time']=['BETWEEN',[$start_time,$end_time]];
                $rs_line=$this->user_sign->where($where)->order('id','desc')->find();
                $in_data['user_id']=$post_data['user_id'];
                $in_data['status']=1;
                if(empty($rs_line)){
                    $in_data['sign_count']=1;
                    $in_data['sign_continuity']=1;
                }else{
                    $in_data['sign_count']= $rs_line['sign_count']+1;
                    $in_data['sign_continuity']=$rs_line['sign_continuity']+1;
                }
                $rs_st=$this->user_sign->allowField(true)->isUpdate(false)->save($in_data);
                if($rs_st!=false){
                    $rs_arr['code']=1;
                    $rs_arr['msg']=lang("SIGN_SUCCESS");
                }else{
                    $rs_arr['code']=0;
                    $rs_arr['msg']=lang("SIGN_ERROR");
                }
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
}
