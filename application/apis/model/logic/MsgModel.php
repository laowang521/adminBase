<?php
namespace app\apis\model\logic;
class MsgModel
{
    /* name:逻辑层初始化方法
     * purpose: 初始化数据库层管理员模型对象
     * return:  无
     * author:longdada
     * write_time:2019/01/22 22:00
     */
    public function __construct()
    {
        $this->region=model('db.Msg');
        $this->validates=validate('Msg');
    }
}
