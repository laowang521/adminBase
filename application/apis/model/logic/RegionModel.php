<?php
namespace app\apis\model\logic;
class RegionModel
{
    /* name:逻辑层初始化方法
     * purpose: 初始化数据库层管理员模型对象
     * return:  无
     * author:longdada
     * write_time:2019/01/22 22:00
     */
    public function __construct()
    {
        $this->region=model('db.Region');
    }
   /* name:省市区三级联动接口
     * purpose: 获取下级地区列表
     * return:  返回地区列表
     * author:longdada
     * write_time:2019/02/03 07:10
     */
    public function get_region_list()
    {
        $post_data=input();
        $validate=validate('Region');
        if($validate->scene('get_region_list')->check($post_data)){
            $where['parent_id']=$post_data['parent_id'];
            $region_list=$this->region->where($where)->select();
            if(!empty($region_list)){
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("GET_SUCCESS");
                $rs_arr['data']=$region_list;
            }else{
                $rs_arr['code']=0;
                $rs_arr['sql']=$this->region->getLastSql();
                $rs_arr['msg']=lang("GET_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$validate->getError();
        }
        return $rs_arr;
    }
    /* name:根据地区id返回地区名字
     * purpose: 将地区ID转换为地区名字
     * param1: 要转换的地区ID
     * return:  返回地区名字
     * author:longdada
     * write_time:2019/02/03 07:30
     */
    public function get_region_name($region_id)
    {
        $where['region_id']=$region_id;
        return $this->region->where($where)->value('region_name');
    }
}
