<?php
namespace app\apis\model\logic;
class UserFollowModel
{
    /* name:逻辑层初始化方法
     * purpose: 初始化数据库层管理员模型对象
     * return:  无
     * author:longdada
     * write_time:2019/01/22 22:00
     */
    public function __construct()
    {
        $this->region=model('db.UserFollow');
        $this->validates=validate('UserFollow');
    }
    /* name:我的关注列表
     * purpose: 获取我关注的店铺,商铺,文章,用户列表
     * return:  返回列表数据
     * author:longdada
     * write_time:2019/02/08 12:10
     */
    public function get_follow_list()
    {
        $post_data=input();
        if($this->validates->scene('get_follow_list')->check($post_data)){
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
}
