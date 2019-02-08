<?php

namespace app\apis\model\db;

use think\Model;

class UserMsgModel extends Model
{
    //设置模型链接的表名(不带前缀)
    protected $name = 'user_msg';
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
     /* name:关联信息内容表
     * purpose: 调用父级模型的初始化方法
     * return:  无
     * author:longdada
     * write_time:2019/01/22 23:06
     */
    public function msg()
    {
        return $this->hasOne('MsgModel','id','msg_id')->field('id,title,content');
    }
   
}
