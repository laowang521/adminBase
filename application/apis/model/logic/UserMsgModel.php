<?php
namespace app\apis\model\logic;
class UserMsgModel
{
    /* name:逻辑层初始化方法
     * purpose: 初始化数据库层管理员模型对象
     * return:  无
     * author:longdada
     * write_time:2019/01/22 22:00
     */
    public function __construct()
    {
        $this->user_msg=model('db.UserMsg');
        $this->validates=validate('UserMsg');
    }
    /* name:获取系统消息列表
     * purpose: 获取系统消息列表
     * return:  返回返回列表记录
     * author:longdada
     * write_time:2019/02/08 10:20
     */
    public function get_system_msg_list()
    {
        $post_data=input();
        if($this->validates->scene('get_system_msg_list')->check($post_data)){
            $where['user_id']=$post_data['user_id'];
            $where['status']=['egt',0];
            $post_data['start']=isset($post_data['start'])&&!empty($post_data['start'])?$post_data['start']:0;
            $post_data['page_size']=isset($post_data['page_size'])&&!empty($post_data['page_size'])?$post_data['page_size']:6;
            $rs_list=$this->user_msg->where($where)->limit($post_data['start'],$post_data['page_size'])->order('id','desc')->select();
            if(!empty($rs_list)){
                foreach($rs_list as &$ve){
                    $ve->msg;
                }
                $rs_arr['code']=1;
                $rs_arr['msg']=lang("GET_SUCCESS");
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
    /* name:获取系统消息详情
     * purpose: 获取某一条系统消息的详情
     * return:  返回返回列表记录
     * author:longdada
     * write_time:2019/02/08 10:20
     */
    public function get_system_msg_details()
    {
        $post_data=input();
        if($this->validates->scene('get_system_msg_details')->check($post_data)){
            $where['id']=$post_data['id'];
            $rs_row=$this->user_msg->where($where)->find();
            $rs_row['msg'];
            if(!empty($rs_row)){
                $rs_arr['code']=1;
                $rs_arr['msg']=lang("GET_SUCCESS");
                $rs_arr['data']=$rs_row;
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
    /* name:系统消息删除
     * purpose: 系统消息单个或批量删除
     * return:  返回删除结果
     * author:longdada
     * write_time:2019/02/08 11:40
     */
    public function get_system_msg_del()
    {
        $post_data=input();
        if($this->validates->scene('get_system_msg_del')->check($post_data)){
            $where['id']=['in',$post_data['id']];
            $rs_st=$this->user_msg->where($where)->delete();
            if($rs_st!=false){
                $rs_arr['code']=1;
                $rs_arr['msg']=lang("DEL_SUCCESS");
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("DEL_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
}
