<?php
namespace app\apis\model\logic;
class UserCouponsModel
{
    /* name:逻辑层初始化方法
     * purpose: 初始化数据库层管理员模型对象
     * return:  无
     * author:longdada
     * write_time:2019/01/22 22:00
     */
    public function __construct()
    {
        $this->user_coupons=model('db.UserCoupons');
        $this->validates=validate('UserCoupons');
    }
    /* name:获取用户优惠券列表
     * purpose: 获取用户拥有的优惠券列表
     * return:  返回列表数据结果
     * author:longdada
     * write_time:2019/02/10 20:37
     */
    public function get_coupons_list()
    {
        $post_data=input();
        if($this->validates->scene('get_coupons_list')->check($post_data)){  
            if($post_data['type']==1){
                $where['u.user_id']=$post_data['user_id'];
            }else if($post_data['type']==2){
                $where['u.user_id']=$post_data['user_id'];
                $where['u.status']=0;
                $time=time();
                $where['c.start_time']=['lt',$time];
                $where['c.end_time']=['gt',$time];
            }else if($post_data['type']==3){
                $where['u.user_id']=$post_data['user_id'];
                $where['u.status']=0;
                $time=time();
                $where['c.end_time']=['lt',$time];
            }
            $post_data['start']=isset($post_data['start'])&&!empty($post_data['start'])?$post_data['start']:0;
            $post_data['page_size']=isset($post_data['page_size'])&&!empty($post_data['page_size'])?$post_data['page_size']:6;
            $rs_list=$this->user_coupons->alias('u')->join('__COUPONS__ c ','c.id= u.coupons_id')->where($where)->limit($post_data['start'],$post_data['page_size'])->order('c.id','desc')->field('u.*')->select();
            if(!empty($rs_list)){
                foreach($rs_list as &$ve){
                    $ve['coupons'];
                }
                $rs_arr['code']=1; 
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
