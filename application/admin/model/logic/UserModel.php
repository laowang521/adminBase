<?php
namespace app\common\model\logic;
class UserModel
{
    /*************************************start公共部分start********************************************************************** */
    /* name:逻辑层初始化方法
     * purpose: 初始化数据库层管理员模型对象
     * return:  无
     * author:longdada
     * write_time:2019/01/22 22:00
     */
    public function __construct()
    {
        $this->user=model('db.User');
    }
    /* name:逻辑层获取列表带分页
     * purpose: 完成管理员列表的数据获取,验证,处理,返回等
     * return:  返回管理员列表数据和分页数据
     * author:longdada
     * write_time:2019/01/22 22:01
     */
    public function get_list_page()
    {
        $post_data=input();
        $where['status']=['egt',0];
        $list=$this->user->where($where)->order(['id'=>'desc'])->paginate(20);
        $page_html=$list->render();
        $rs_arr['list']=$list;
        $rs_arr['page_size']=$page_html;
        $rs_arr['count']= $this->user->where($where)->count();
        return $rs_arr;
    }
    /* name:逻辑层获取列表
     * purpose: 完成管理员列表的数据获取,验证,处理,返回等
     * return:  返回管理员列表数据和分页数据
     * author:longdada
     * write_time:2019/01/22 22:01
     */
    public function get_list()
    {
        $post_data=input();
        $where['status']=['egt',0];
        $list=$this->user->where($where)->order(['id'=>'desc'])->select();
        foreach($list as &$ve){
            $ve['role_name']='超级管理员';
        }
        $rs_data['list']=$list;
        $rs_data['total']=$this->user->where($where)->count();
        $rs_arr['code']=1;
        $rs_arr['data']=$rs_data;
        return $rs_arr;
    }
    /* name:保存管理员添加
     * purpose: 管理员添加成功保存管理员信息
     * return:  返回保存结果信息
     * author:longdada
     * write_time:2019/01/22 22:06
     */
    public function save_add()
    {
        $post_data=input();
        $validate=validate('User');
        if($validate->scene('save_add')->check($post_data)){
            $post_data['user_sn']= generate_random_str(1,40,3).generate_random_str(46,54,8);
            $post_data['mobile']=$post_data['user_login'];
            $pass_arr=generate_passwd($post_data['passwd']);
            $post_data['passwd']=$pass_arr['pass'];
            $post_data['passwd_code']=$pass_arr['pass_code'];
            $rs_st=$this->user->allowField(true)->save($post_data);
            if($rs_st!=false){
                $rs_arr['code']=1;
                $rs_arr['data']=$this->user->id;
                $rs_arr['msg']=lang("REG_SUCCESS");
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("REG_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$validate->getError();
        }
        return $rs_arr;
    }
    /* name:保存管理员编辑
     * purpose: 保存管理员编辑信息
     * return:  返回保存结果信息
     * author:longdada
     * write_time:2019/01/22 22:06
     */
    public function save_edit()
    {
        $post_data=input();
        $validate=validate('admin');
        if($validate->scene('save_edit')->check($post_data)){
            $where['login']=$post_data['login'];
            $admin_row=$this->user->where($where)->find();
            if($admin_row['id']==$post_data['id']){
                if(!empty($post_data['password'])){
                    $pass_arr=generate_passwd($post_data['password']);
                    $post_data['password']=$pass_arr['pass'];
                    $post_data['password_code']=$pass_arr['pass_code'];
                }else{
                    unset($post_data['password']);
                }
                $rs_st=$this->user->allowField(true)->isUpdate(true)->save($post_data);
                if($rs_st!=false){
                    $rs_arr['code']=1;
                    $rs_arr['msg']=lang("SAVE_SUCCESS");
                }else{
                    $rs_arr['code']=0;
                    $rs_arr['msg']=lang("SAVE_ERROR");
                }
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("ACCOUNT_EXIST");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$validate->getError();
        }
        return $rs_arr;
    }
    /* name:获取一行(带参数版)
    * purpose: 根据管理员ID获取管理员信息
    * parameter1: 管理员ID 
    * return:  返回管理员信息
    * author:longdada
    * write_time:2019/01/24 23:06
    */
    public function get_row($id=NULL)
    {
        $post=input();
        $validate=validate('admin');
        if($validate->scene('get_row')->check($post_data)){
            $where['id']=$post_data['id'];
            $rs_row=$this->admin->where($where)->find();
            $rs_data['roles']=['admin'];
            $rs_data['name']=$rs_row['name'];
            $rs_data['avatar']=$rs_row['avatar'];
            $rs_data['introduction']=$rs_row['introduction'];
            if($rs_row!=false){
                $rs_arr['code']=1;
                $rs_arr['data']=$rs_data;
                $rs_arr['msg']=lang("GET_SUCCESS");
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("GET_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$validate->getError();
        }
        return $rs_arr;
    }
    /* name:根据条件获取一行(带参数版)
     * purpose: 根据传入条件获取管理员信息
     * return:  返回管理员信息
     * author:longdada
     * write_time:2019/01/25 14:22
     */
    public function get_where_row($where)
    {
        $rs_row=$this->admin->where($where)->find();
        if($rs_row!=false){
            $rs_arr['code']=1;
            $rs_arr['data']=$rs_row;
            $rs_arr['msg']=lang("GET_SUCCESS");
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=lang("GET_ERROR");
        }
    }
    /* name:删除方法
     * purpose: 处理删除管理员
     * return:  返回删除结果
     * author:longdada
     * write_time:2019/01/25 14:22
     */
    public function del_where_row()
    {
        $post_data=input();
        $validate=validate('admin');
        if($validate->scene('del_where_row')->check($post_data)){
            $where['id']=['in',$post['id']];
            $up_data['status']='-1';
            $rs_row=$this->admin->where($where)->allowField(true)->isUpdate(true)->save($up_data);
            if($rs_row!=false){
                $rs_arr['code']=1;
                $rs_arr['data']=$rs_row;
                $rs_arr['msg']=lang("GET_SUCCESS");
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("GET_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$validate->getError();
        }
        return $rs_arr;
    }
    /*********************************end公共部分end******************************************************************** */
    /*********************************start专属部分start******************************************************************** */
    /* name:管理员登陆
     * purpose: 处理管理员登陆请求
     * return:  返回处理结果信息
     * author:longdada
     * write_time:2019/01/22 23:06
     */
    public function login()
    {
        $post_data=input();
        $validate=validate('admin');
        if($validate->scene('login')->check($post_data)){
            //if(captcha_check($post_data['captcha'])){
            if(false){
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("VALIDATE_CODE_ERROR");
            }else{
                $where['login']=$post_data['login'];
                $where['status']=1;
                $rs_row=$this->admin->where($where)->find();
                if(empty($rs_row)){
                    $rs_arr['code']=0;
                    $rs_arr['msg']=lang("NOT_REGISTER");
                }else{
                    $new_pass=diff_passwd($post_data['password'],$rs_row['password_code']);
                    if($new_pass==$rs_row['password']){
                        //此处应记录登陆状态
                        //更新上次登录记录
                        $up_data['id']=$rs_row['id'];
                        $up_data['login_token']=request()->token('__token__', 'sha1');
                        $up_data['time_out']=time()+180;
                        $up_data['last_login_ip']=request()->ip();
                        $up_data['last_login_time']=time();
                        $this->admin->allowField(true)->isUpdate(true)->save($up_data);
                        $rs_data['token']=$up_data['login_token'];
                        $rs_arr['code']=1;
                        $rs_arr['data']=$rs_data;
                        $rs_arr['msg']=lang("LOGIN_SUCCESS");
                    }else{
                        $rs_arr['code']=0;
                        $rs_arr['msg']=lang("PASSWD_ERROR");
                    }
                }
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$validate->getError();
        }
        return $rs_arr;
    }
     /* name:管理员重置密码
     * purpose: 处理管理员修改密码请求
     * return:  返回处理结果信息
     * author:longdada
     * write_time:2019/01/24 23:06
     */
    public function reset_passwd()
    {
        $post_data=input();
        $validate=validate('admin');
        if($validate->scene('reset_passwd')->check($post_data)){
            $pass_arr=generate_passwd($post_data['password']);
            $post_data['password']=$pass_arr['pass'];
            $post_data['password_code']=$pass_arr['pass_code'];
            $rs_st=$this->admin->allowField(true)->isUpdate(true)->save($post_data);
            if($rs_st!=false){
                $rs_arr['code']=1;
                $rs_arr['msg']=lang("SAVE_SUCCESS");
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("SAVE_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$validate->getError();
        }
        return $rs_arr;
    }
    /* name:验证登陆
     * purpose: 验证管理账号状态是否可用
     * return:  返回验证结果信息
     * author:longdada
     * write_time:2019/01/24 23:06
     */
    public function validate_login($admin_id)
    {
        $where['id']=$admin_id;
        $where['status']=1;
        $where['role_id']=['gt',0];
        $where['shop_id']=['gt',0];
        $rs_row=$this->admin->where($where)->find();
        if(empty($rs_row)){
            $rs_arr['code']=0;
        }else{
            $rs_arr['code']=1;
        }
        return $rs_arr;
    }
    /* name:获取角色ID
     * purpose: 根据管理员的ID获取该管理员的角色ID
     * return:  返回管理员的角色ID
     * author:longdada
     * write_time:2019/01/25 14:00
     */
    public function get_role_id($admin_id)
    {
        $where['id']=$admin_id;
        $rs_role_id=$this->admin->where($where)->value('role_id');
        if($rs_role_id!=false){
            $rs_arr['code']=1;
            $rs_arr['data']=$rs_role_id;
            $rs_arr['msg']=lang("GET_SUCCESS");
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=lang("GET_ERROR");
        }
        return $rs_arr;
    }
    /* name:判断是否有管理员
     * purpose: 判断某个角色下是否有管理员
     * return:  范围查询结果
     * author:longdada
     * write_time:2019/01/25 14:00
     */
    public function get_role_admin_list($role_id)
    {
        $where['role']=$role_id;
        $rs_row=$this->admin->where($where)->find();
        if(!empty($rs_row)){
            $rs_arrp['code']=1;
        }else{
            $rs_arrp['code']=0;
        }
        return $rs_row;
    }
    /* name:获取未分配管理员列表
     * purpose: 获取未分配店铺的店铺管理员列表
     * return:  返回管理员列表
     * author:longdada
     * write_time:2019/01/25 14:29
     */
    public function get_shop_admin_list()
    {
        $where['role_id']=3;
        $where['shop_id']=1;
        $rs_list=$this->admin->where($where)->select();
        if(empty($rs_list)){
            $rs_arr['code']=0;
            $rs_arr['msg']=lang("NOT_SHOP_ADMIN");
        }else{
            $rs_arr['code']=1;
            $rs_arr['data']=$rs_list;
        }
        return $rs_arr;
    }
    /* name:入驻成功增加管理员
     * purpose: 入驻申请成功自动根据申请人账号生成管理员账号
     * return:  返回生成结果
     * author:longdada
     * write_time:2019/01/25 16:14
     */
    public function save_shop_add($shop_id)
    {
        return $rs_arr;
    }
    /* name:更新管理员所属店铺
     * purpose: 后台给管理员配置完店铺后更新管理员店铺ID
     * return:  返回更新结果
     * author:longdada
     * write_time:2019/01/25 16:14
     */
    public function update_admin_shop($in_arr)
    {
        $post_data=input();
        $validate=validate('admin');
        if($validate->scene('reset_passwd')->check($post_data)){

        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$validate->getError();
        }
        return $rs_arr;
    }
    /* name:验证token
     * purpose: 根据前端发过来的token获取管理员信息
     * return:  返回管理员信息
     * author:longdada
     * write_time:2019/01/27 06:14
     */
    public function validate_token()
    {
        $where['login_token']=get_token();
        $where['time_out']=['gt',time()];
        $rs_row=$this->admin->where($where)->find();
        if(empty($rs_row)){
            $rs_arr['code']=2;
            $rs_arr['msg']='登陆超时请重新登陆';
        }else{
            $up_data['id']=$rs_row['id'];
            $up_data['time_out']=time()+300;
            $this->admin->allowField(true)->isUpdate(true)->save($up_data);
            cache($where['login_token'], $rs_row, 300);
            $rs_arr['code']=1;
            $rs_arr['msg']='token正常';
        }
        return $rs_arr;
    }
    /* name:获取管理员的信息
     * purpose: 获取当前登录的管理员信息
     * parameter1: 无 
     * return:  返回登录的管理员信息
     * author:longdada
     * write_time:2019/01/29 08:22
     */
    public function get_info()
    {
        $post=input();
        $validate=validate('admin');
        if($validate->scene('get_row')->check($post_data)){
            $where['id']=$post_data['id'];
            $rs_row=$this->admin->where($where)->find();
            $rs_data['roles']=['admin'];
            $rs_data['name']=$rs_row['name'];
            $rs_data['avatar']=$rs_row['avatar'];
            $rs_data['introduction']=$rs_row['introduction'];
            if($rs_row!=false){
                $rs_arr['code']=1;
                $rs_arr['data']=$rs_data;
                $rs_arr['msg']=lang("GET_SUCCESS");
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("GET_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$validate->getError();
        }
        return $rs_arr;
    }
    /*********************************end专属部分end******************************************************************** */
}
