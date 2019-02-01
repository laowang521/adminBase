<?php

namespace app\common\model\db;

use think\Model;

class UserModel extends Model
{
    /** *************start公有部分start*******************************************************/
    //设置模型链接的表名(不带前缀)
    protected $name = 'user';
    //新增时自动完成添加时间和更新时间
    protected $insert = ['add_time','update_time']; 
    //更新时自动完成更新时间
    protected $update = ['update_time'];  
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
    /* name:数据完成方法
     * purpose: 添加时间自动完成不需手工调用
     * return:  返回需要设置的值
     * author:longdada
     * write_time:2019/01/22 23:06
     */
    protected function setAddTimeAttr()
    {
        return time();
    }
    /* name:数据完成方法
     * purpose: 添加时间自动完成不需手工调用
     * return:  返回需要设置的值
     * author:longdada
     * write_time:2019/01/22 23:06
     */
    protected function setUpdateTimeAttr()
    {
        return time();
    }
    /** *************end公有部分end***********************************************/
    /** *************start专属部分start*******************************************************/
  
    /** *************end专属部分end*******************************************************/
}
