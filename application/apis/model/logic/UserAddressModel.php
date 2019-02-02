<?php
namespace app\apis\model\logic;
class UserAddressModel
{
    /* name:逻辑层初始化方法
     * purpose: 初始化数据库层管理员模型对象
     * return:  无
     * author:longdada
     * write_time:2019/01/22 22:00
     */
    public function __construct()
    {
        $this->address=model('db.UserAddress');
    }
     /* name:获取收货地址列表
     * purpose: 根据用户ID获取用户列表
     * return:  返回列表数据
     * author:longdada
     * write_time:2019/02/02 08:29
     */
    public function get_address_list()
    {
        $post_data=input();
        $validate=validate('UserAddress');
        if($validate->scene('get_address_list')->check($post_data)){
            $where['user_id']=$post_data['user_id'];
            $post_data['start']=isset($post_data['start'])&&!empty($post_data['start'])?$post_data['start']:0;
            $post_data['page_size']=isset($post_data['page_size'])&&!empty($post_data['page_size'])?$post_data['page_size']:6;
            $rs_list=$this->address->where($where)->limit($post_data['start'],$post_data['page_size'])->order('id','desc')->selecxt();
            if(！empty($rs_list)){
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("GET_SUCCESS");
                $rs_arr['data']=$rs_list;
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("GET_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$validate->getError();
        }
        return $rs_arr;
    }
}
