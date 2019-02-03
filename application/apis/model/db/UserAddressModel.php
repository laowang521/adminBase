<?php

namespace app\apis\model\db;

use think\Model;

class UserAddressModel extends Model
{
    //设置模型链接的表名(不带前缀)
    protected $name = 'user_address';
    /* name:数据库层初始化方法
     * purpose: 调用父级模型的初始化方法
     * return:  无
     * author:longdada
     * write_time:2019/01/22 23:06
     */
    public function initialize()
    {
        parent::initialize();
    }
    /* name:根据省份ID获取省份名称
     * purpose: 根据省份ID获取省份名称
     * return:  省份名称
     * author:longdada
     * write_time:2019/02/03 07:53
     */
    public function getProvinceTextAttr($value,$data)
    {
        return  model('service.Region')->get_region_name($data['province']);
    }
    /* name:根据城市ID获取城市名称
     * purpose: 根据城市ID获取城市名称
     * return:  城市名称
     * author:longdada
     * write_time:2019/02/03 07:53
     */
    public function getCityTextAttr($value,$data)
    {
        var_dump($data['city']);
        return  model('service.Region')->get_region_name($data['city']);
    }
    /* name:根据地区ID获取地区名称
     * purpose: 根据地区ID获取地区名称
     * return:  地区名称
     * author:longdada
     * write_time:2019/02/03 07:53
     */
    public function getDistrictTextAttr($value,$data)
    {
        return  model('service.Region')->get_region_name($data['district']);
    }
}
