<?php

namespace app\common\model\service;
class UserModel 
{
    /***********************************start公共部分start********************************************/
    /* name:初始化函数
     * purpose: 管理员模型初始化方法,初始化管理员逻辑层方法对象.
     * return:  无
     * author:longdada
     * write_time:2019/01/22 21:51
     */
    public function __construct()
    {
        $this->admin=model('logic.User');
    }
    /* name:获取列表带分页版
     * purpose: 获取管理员列表和分页数据
     * return:  返回管理员数据列表和分页数据
     * author:longdada
     * write_time:2019/01/22 21:51
     */
    public function get_list_page()
    {
        return  $this->admin-> get_list_page();
    }
    /* name:逻辑层获取列表
     * purpose: 调用逻辑层处理方法
     * return:  返回管理员列表数据
     * author:longdada
     * write_time:2019/01/28 10:01
     */
    public function get_list()
    {
        return  $this->admin-> get_list();
    }
    /* name:保存管理员添加
     * purpose: 保存管理员添加信息
     * return:  返回保存结果信息
     * author:longdada
     * write_time:2019/01/22 22:06
     */
    public function save_add()
    {
        return  $this->admin->save_add();
    }
    /* name:保存管理员编辑
     * purpose: 保存管理员编辑信息
     * return:  返回保存结果信息
     * author:longdada
     * write_time:2019/01/22 22:06
     */
    public function save_edit()
    {
        return  $this->admin->save_edit();
    }
    /* name:获取一行
     * purpose: 根据管理员ID获取管理员信息
     * return:  返回管理员信息
     * author:longdada
     * write_time:2019/01/24 23:06
     */
    public function get_row()
    {
        return  $this->admin->get_row();
    }
    /* name:获取一行(带参数版)
    * purpose: 根据管理员ID获取管理员信息
    * return:  返回管理员信息
    * author:longdada
    * write_time:2019/01/24 23:06
    */
    public function get_id_row($id)
    {
        return  $this->admin->get_row($id);
    }
    /* name:根据条件获取一行(带参数版)
     * purpose: 根据传入条件获取管理员信息
     * return:  返回管理员信息
     * author:longdada
     * write_time:2019/01/25 14:22
     */
    public function get_where_row($where)
    {
        return  $this->admin->get_where_row($where);
    }
    /* name:删除管理员
     * purpose: 删除管理员处理
     * return:  返回删除结果
     * author:longdada
     * write_time:2019/01/25 14:22
     */
    public function del_where_row()
    {
        return  $this->admin->del_where_row();
    }
    /******************************end公共部分end***************************************************** */
    /******************************start专属部分start***************************************************** */
    /* name:管理员登陆
     * purpose: 处理管理员登陆请求
     * return:  返回处理结果信息
     * author:longdada
     * write_time:2019/01/22 23:06
     */
    public function login()
    {
        return  $this->admin->login();
    }
    /* name:管理员重置密码
     * purpose: 处理管理员修改密码请求
     * return:  返回处理结果信息
     * author:longdada
     * write_time:2019/01/24 23:06
     */
    public function reset_passwd()
    {
        return  $this->admin->reset_passwd();
    }
    /* name:验证登陆
     * purpose: 验证管理账号状态是否可用
     * return:  返回验证结果信息
     * author:longdada
     * write_time:2019/01/24 23:06
     */
    public function validate_login($admin_id)
    {
        return  $this->admin->validate_login($admin_id);
    }
    /* name:获取角色ID
     * purpose: 根据管理员的ID获取该管理员的角色ID
     * return:  返回管理员的角色ID
     * author:longdada
     * write_time:2019/01/25 14:00
     */
    public function get_role_id($admin_id)
    {
        return  $this->admin->get_role_id($admin_id);
    }
    /* name:判断是否有管理员
     * purpose: 判断某个角色下是否有管理员
     * return:  范围查询结果
     * author:longdada
     * write_time:2019/01/25 14:00
     */
    public function get_role_admin_list($role_id)
    {
        return  $this->admin->get_role_id($role_id);
    }
    /* name:获取未分配管理员列表
     * purpose: 获取未分配店铺的店铺管理员列表
     * return:  返回管理员列表
     * author:longdada
     * write_time:2019/01/25 14:29
     */
    public function get_shop_admin_list()
    {
        return  $this->admin->get_shop_admin_list();
    }
    /* name:入驻成功增加管理员
     * purpose: 入驻申请成功自动根据申请人账号生成管理员账号
     * return:  返回生成结果
     * author:longdada
     * write_time:2019/01/25 16:14
     */
    public function save_shop_add($shop_id)
    {
        return  $this->admin->save_shop_add($shop_id);
    }
    /* name:更新管理员所属店铺
     * purpose: 后台给管理员配置完店铺后更新管理员店铺ID
     * return:  返回更新结果
     * author:longdada
     * write_time:2019/01/25 16:14
     */
    public function update_admin_shop($in_arr)
    {
        return  $this->admin->update_admin_shop($in_arr);
    }
    /* name:验证token
     * purpose: 根据前端发过来的token获取管理员信息
     * return:  返回管理员信息
     * author:longdada
     * write_time:2019/01/27 06:14
     */
    public function validate_token()
    {
        return  $this->admin->validate_token();
    }
    /* name:获取登录管理员的信息
     * purpose: 获取登录管理员的信息
     * return:  返回登录管理员信息
     * author:longdada
     * write_time:2019/01/29 08:17
     */
    public function get_info()
    {
        return  $this->admin->get_info();
    }
    /******************************end专属部分end***************************************************** */
}
