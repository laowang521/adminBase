<?php
namespace app\admin\controller;
class AdminController extends BaseController
{
    /* name:初始化方法
     * purpose: 后台管理员初始化服务层模型方法
     * return:  无
     * author:longdada
     * write_time:2019/01/29 08:03
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->admin=model('service.admin');
    }
    /* name:获取登录账号管理员信息
     * purpose: 获取登录的管理员的信息
     * return:  返回登录的管理员信息
     * author:longdada
     * write_time:2019/01/29 08:03
     */
    public function GetAdminInfoOp()
    {
        $rs_data=$this->admin->get_info();
        return json($rs_data);
    }
    /* name:获取指定管理员信息
     * purpose: 获取指定的管理员的信息
     * return:  返回指定的管理员信息
     * author:longdada
     * write_time:2019/01/29 08:14
     */
    public function GetAdminRowOp()
    {
        $rs_data=$this->admin->get_row();
        return json($rs_data);
    }
    /* name:获取管理员列表
     * purpose: 获取后台管理员列表
     * return:  返回管理员列表数据
     * author:longdada
     * write_time:2019/01/29 08:03
     */
    public function GetAdminListOp()
    {
        $rs_data=$this->admin->get_list();
        return json($rs_data);
    }
    /* name:保存添加
     * purpose: 添加后台管理员保存
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/01/29 08:03
     */
    public function SaveAdminAddOp()
    {
        $rs_data=$this->admin->save_add();
        return json($rs_data);
    }
    /* name:保存编辑
     * purpose: 编辑后台管理员保存
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/01/29 08:03
     */
    public function SaveAdminEditOp()
    {
        $rs_data=$this->admin->save_edit();
        return json($rs_data);
    }
}
