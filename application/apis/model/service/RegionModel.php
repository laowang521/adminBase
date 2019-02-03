<?php

namespace app\apis\model\service;
class RegionModel 
{
    /* name:初始化函数
     * purpose: 系统模型初始化方法,初始化系统逻辑层类对象.
     * return:  无
     * author:longdada
     * write_time:2019/01/30 14:50
     */
    public function __construct()
    {
        $this->region=model('logic.Region');
    }
    /* name:省市区三级联动接口
     * purpose: 获取下级地区列表
     * return:  返回地区列表
     * author:longdada
     * write_time:2019/02/02 23:39
     */
    public function get_region_list()
    {
        return  $this->region-> get_region_list();
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
        return  $this->region-> get_region_name($region_id);
    }
}
