<?php
namespace app\admin\controller;
class IndexController extends BaseController
{
    /* name:初始化方法
     * purpose: 主页类初始化方法
     * return:  无
     * author:longdada
     * write_time:2019/01/29 08:05
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->admin=model('service.admin');
    }
    public function GetAdminRowOp()
    {
        $rs_data=$this->admin->get_row();
        return json($rs_data);
    }
}
