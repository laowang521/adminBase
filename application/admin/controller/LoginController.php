<?php
namespace app\admin\controller;
use think\Controller;
class LoginController extends Controller
{
    /* name:初始化方法
     * purpose: 登录类初始化方法
     * return:  无
     * author:longdada
     * write_time:2019/01/29 08:04
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->admin=model('service.admin');
    }
    /* name:登录方法
     * purpose: 登录类登录方法
     * return:  返回登录结果
     * author:longdada
     * write_time:2019/01/29 08:09
     */
    public function IndexOp()
    {
        $rs_data=$this->admin->login();
        return json($rs_data);
    }
}
