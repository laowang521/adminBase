<?php
namespace app\apis\model\logic;
class UserModel
{
    /* name:初始化函数
     * purpose: 管理员模型初始化方法,初始化管理员逻辑层方法对象.
     * return:  无
     * author:longdada
     * write_time:2019/01/22 21:51
     */
    public function __construct()
    {
        $this->user=model('db.User');
        $this->validates=validate('User');
    }
    /* name:验证手机号
     * purpose: 验证手机号是否合法
     * return:  返回验证结果结果
     * author:longdada
     * write_time:2019/01/30 14:24
     */
    public function validate_mobile()
    {
        $post_data=input();
        if($this->validates->scene('validate_mobile')->check($post_data)){
            if($post_data['send_type']==1){
                $this->validates_data=$this->validates->scene('validate_mobile_1')->check($post_data); 
            }else if($post_data['send_type']==2){
                $this->validates_data=$this->validates->scene('validate_mobile_2')->check($post_data);     
            }
            if($this->validates_data){
                if($post_data['send_type']==2){
                    $rs_row=$this->user->where(['user_login'=>$post_data['user_login']])->find();
                    if(!empty($rs_row)){
                        $rs_arr['code']=1;
                        $rs_arr['msg']=lang("VALI_SUCCESS");
                    }else{
                        $rs_arr['code']=0;
                        $rs_arr['msg']=lang("ACCOUNT_NOT_EXIST");
                    }
                }else{
                    $rs_arr['code']=1;
                    $rs_arr['msg']=lang("VALI_SUCCESS");
                }
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=$this->validates->getError();
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
   /* name:发送短信验证码
     * purpose: 发送短信验证码
     * return:  返回发送结果
     * author:longdada
     * write_time:2019/01/29 18:12
     */
    public function send_sms()
    {
        $post_data=input();
        if($this->validates->scene('send_sms')->check($post_data)){
            $send_code=generate_random_str(46,54,6);
            $rs_arr['code']=1;
            $rs_arr['data']=$send_code;
            $rs_arr['msg']='发送成功';
            // if(sendSMS($post_data['user_login'],$send_code)){
            //     $rs_arr['code']=1;
            //     $rs_arr['data']=$send_code;
            //     $rs_arr['msg']='发送成功';
            // }else{
            //     $rs_arr['code']=0;
            //     $rs_arr['msg']='发送失败';
            // }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:注册方法
     * purpose: 用户注册接口
     * return:  返回注册结果
     * author:longdada
     * write_time:2019/01/30 15:10
     */
    public function register()
    {
        $post_data=input();
        if($this->validates->scene('register')->check($post_data)){
            $post_data['user_sn']=generate_random_str(2,42,4).generate_random_str(46,54,6);
            $post_data['mobile']=$post_data['user_login'];
            $pass_arr=generate_passwd($post_data['passwd']);
            $post_data['passwd']=$pass_arr['pass'];
            $post_data['passwd_code']=$pass_arr['pass_code'];
            $post_data['head_img']="/uploads/default/user_moren.jpg";
            $rs_st=$this->user->allowField(true)->isUpdate(false)->save($post_data);
            if($rs_st!==false){
                $rs_arr['code']=1;
                $rs_arr['msg']=lang("REG_SUCCESS");
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("REG_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:密码登录方法
     * purpose: 用户密码登录接口
     * return:  返回登录结果
     * author:longdada
     * write_time:2019/01/29 14:09
     */
    public function passwd_login()
    {
        $post_data=input();
        if($this->validates->scene('passwd_login')->check($post_data)){
            $user_where['user_login']=$post_data['user_login'];
            $rs_row=$this->user->where($user_where)->find();
            if(empty($rs_row)){
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("REG_NOT");
            }else{
                $new_pass=diff_passwd($post_data['passwd'],$rs_row['passwd_code']);
                if($new_pass==$rs_row['passwd']){
                    $up_data['id']= $rs_row['id'];
                    $up_data['last_login_time']= time();
                    $up_data['last_login_ip']= request()->ip();
                    $this->user->allowField(true)->isUpdate(true)->save($up_data);
                    $rs_arr['code']=1;
                    $rs_arr['data']=$rs_row['id'];
                    $rs_arr['msg']=lang("LOGIN_SUCCESS");
                }else{
                    $rs_arr['code']=0;
                    $rs_arr['msg']=lang("LOGIN_ERROR");
                }
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:验证码登录方法
     * purpose: 用户验证码登录接口
     * return:  返回登录结果
     * author:longdada
     * write_time:2019/01/30 9:29
     */
    public function code_login()
    {
        $post_data=input();
        if($this->validates->scene('code_login')->check($post_data)){
            $user_where['user_login']=$post_data['user_login'];
            $rs_row=$this->user->where($user_where)->find();
            if(empty($rs_row)){
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("REG_NOT");
            }else{
                $up_data['id']= $rs_row['id'];
                $up_data['last_login_time']= time();
                $up_data['last_login_ip']= request()->ip();
                $this->user->allowField(true)->isUpdate(true)->save($up_data);
                $rs_arr['code']=1;
                $rs_arr['data']=$rs_row['id'];
                $rs_arr['msg']=lang("LOGIN_SUCCESS");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:忘记密码方法
     * purpose: 用户忘记密码接口
     * return:  返回重置密码结果
     * author:longdada
     * write_time:2019/01/30 9:41
     */
    public function forget_passwd()
    {
        $post_data=input();
        if($this->validates->scene('forget_passwd')->check($post_data)){
            $user_where['user_login']=$post_data['user_login'];
            $rs_row=$this->user->where($user_where)->find();
            if(empty($rs_row)){
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("REG_NOT");
            }else{
                $new_pass=diff_passwd($post_data['passwd'],$rs_row['passwd_code']);
                if($new_pass==$rs_row['passwd']){
                    $rs_arr['code']=0;
                    $rs_arr['msg']=lang("PASSWD_EQUAL");
                }else{
                    $pass_arr=generate_passwd($post_data['passwd']);
                    $up_data['passwd']=$pass_arr['pass'];
                    $up_data['passwd_code']=$pass_arr['pass_code'];
                    $up_data['id']=$rs_row['id'];
                    $rs_st=$this->user->allowField(true)->isUpdate(true)->save($up_data);
                    if($rs_st!==false){
                        $rs_arr['code']=1;
                        $rs_arr['msg']=lang("SUB_SUCCESS");
                    }else{
                        $rs_arr['code']=0;
                        $rs_arr['msg']=lang("SUB_ERROR");
                    }
                }
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
     /* name:更换手机号
     * purpose: 用户更换手机号接口
     * return:  返回更换结果
     * author:longdada
     * write_time:2019/01/30 10:01
     */
    public function bind_mobile()
    {
        $post_data=input();
        if($this->validates->scene('bind_mobile')->check($post_data)){
            $rs_st=$this->user->allowField(true)->isUpdate(true)->save($post_data);
            if($rs_st!==false){
                $rs_arr['code']=1;
                $rs_arr['msg']=lang("SUB_SUCCESS");
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("SUB_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:修改密码
     * purpose: 修改密码
     * return:  返回修改结果
     * author:longdada
     * write_time:2019/01/30 19:01
     */
    public function reset_passwd()
    {
        $post_data=input();
        if($this->validates->scene('reset_passwd')->check($post_data)){
            $user_where['id']=$post_data['id'];
            $rs_row=$this->user->where($user_where)->find();
            if(empty($rs_row)){
                $rs_arr['code']=1;
                $rs_arr['msg']=lang("NOT_USER_INFO");
            }else{
                $new_pass=diff_passwd($post_data['passwd'],$rs_row['passwd_code']);
                if($new_pass==$rs_row['passwd']){
                    $rs_arr['code']=0;
                    $rs_arr['msg']=lang("PASSWD_EQUAL");
                }else{
                    $pass_arr=generate_passwd($post_data['passwd']);
                    $up_data['passwd']=$pass_arr['pass'];
                    $up_data['passwd_code']=$pass_arr['pass_code'];
                    $up_data['id']=$rs_row['id'];
                    $rs_st=$this->user->allowField(true)->isUpdate(true)->save($up_data);
                    if($rs_st!==false){
                        $rs_arr['code']=1;
                        $rs_arr['msg']=lang("SUB_SUCCESS");
                    }else{
                        $rs_arr['code']=0;
                        $rs_arr['msg']=lang("SUB_ERROR");
                    }
                }
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:获取个人资料信息
     * purpose: 获取用户信息接口
     * return:  返回更换结果
     * author:longdada
     * write_time:2019/01/30 17:01
     */
    public function get_user_info()
    {
        $post_data=input();
        if($this->validates->scene('get_user_info')->check($post_data)){
            $user_where['id']=$post_data['id'];
            $rs_row=$this->user->where($user_where)->find();
            if(!empty($rs_row)){
                $rs_arr['code']=1;
                $rs_arr['data']=$rs_row;
                $rs_arr['msg']=lang("GET_SUCCESS");
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("GET_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:保存个人资料信息
     * purpose: 保存用户信息接口
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/01/31 10:01
     */
    public function save_user_info()
    {
        $post_data=input();
        if($this->validates->scene('save_user_info')->check($post_data)){
            $where['id']=$post_data['id'];
            $rs_row=$this->user->where($where)->find();
            if(empty($rs_row)){
                $rs_arr['code']=1;
                $rs_arr['msg']=lang("NOT_USER_INFO");
            }else{
                $rs_st=$this->user->allowField(true)->isUpdate(true)->save($post_data);
                if(!empty($rs_st)){
                    $rs_arr['code']=1;
                    $rs_arr['msg']=lang("SUB_SUCCESS");
                }else{
                    $rs_arr['code']=0;
                    $rs_arr['msg']=lang("SUB_ERROR");
                }
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:上传会员头像
     * purpose: 上传用户头像
     * return:  返回头像保存地址
     * author:longdada
     * write_time:2019/01/31 10:01
     */
    public function upload_img_file_user()
    {
        $post_data=input();
        if($this->validates->scene('upload_img_file_user')->check($post_data)){
            $where['id']=$post_data['id'];
            $rs_row=$this->user->where($where)->find();
            if(!empty($rs_row['head_img'])&&file_exists(".".$rs_row['head_img'])){//如果原头像文件存在就删除文件
                unlink(".".$rs_row['head_img']);
            }
            $file=request()->file('head_img');
            if($file){
                $img_url=upload_file_object($file);//上传文件
                $thumb_url=image_thumb($img_url,400,400);//生成缩略图
                $up_data['id']=$post_data['id'];
                $up_data['head_img']=$thumb_url;
                $this->user->allowField(true)->isUpdate(true)->save($up_data);
                $rs_arr['code']=1;
                $rs_arr['data']=$thumb_url;
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("IMG_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
     /* name:上传会员头像(base64数据流形式)
     * purpose: 上传用户头像
     * return:  返回头像保存地址
     * author:longdada
     * write_time:2019/01/31 16:49
     */
    public function upload_img_base64_user()
    {
        $post_data=input();
        if($this->validates->scene('upload_img_base64_user')->check($post_data)){
            $where['id']=$post_data['id'];
            $rs_row=$this->user->where($where)->find();
            if(!empty($rs_row['head_img'])&&file_exists(".".$rs_row['head_img'])){//如果原头像文件存在就删除文件
                unlink(".".$rs_row['head_img']);
            }
            $img_url=upload_file_base64($post_data['head_img']);//上传文件
            $thumb_url=image_thumb($img_url,400,400);//生成缩略图
            $up_data['id']=$post_data['id'];
            $up_data['head_img']=$thumb_url;
            $this->user->allowField(true)->isUpdate(true)->save($up_data);
            $rs_arr['code']=1;
            $rs_arr['data']=$thumb_url;
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:获取用户id获取用户信息
     * purpose: 获取用户id获取用户信息
     * param1: 用户id
     * return:  返回用户信息set_address_default
     * author:longdada
     * write_time:2019/02/03 08:49
     */
    public function get_user_row($user_id)
    {
        $where['id']=$user_id;
        $rs_row=$this->user->where($where)->find();
        if(!empty($rs_row)){
            $rs_arr['code']=1;
            $rs_arr['msg']=lang("GET_SUCCESS");
            $rs_arr['data']=$rs_row;
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=lang("GET_ERROR");
        }
        return $rs_arr;
    }
     /* name:设置用户默认收货地址
     * purpose: 设计用户的默认收货地址
     * param1: 用户id
     * param2: 地址id
     * return:  返回设置结果
     * author:longdada
     * write_time:2019/02/03 08:49
     */
    public function set_address_default($user_id,$address_id)
    {
        $up_data['id']=$user_id;
        $up_data['address_id']=$address_id;
        $rs_st=$this->user->allowField(true)->isUpdate(true)->save($up_data);
        if($rs_st!==false){
            $rs_arr['code']=1;
            $rs_arr['msg']=lang("SUB_SUCCESS");
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=lang("SUB_ERROR");
        }
    }
    /* name:设置用户默认收货地址
     * purpose: 用户在收货地址列表页设置默认收货地址
     * return:  返回设置结果
     * author:longdada
     * write_time:2019/02/03 09:32
     */
    public function user_set_address_default()
    {
        $post_data=input();
        if($this->validates->scene('user_set_address_default')->check($post_data)){
            $rs_st=$this->user->allowField(true)->isUpdate(true)->save($post_data);
            if($rs_st!==false){
                $rs_arr['code']=1;
                $rs_arr['msg']=lang("SET_SUCCESS");
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("SET_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:获取用户账号总余额
     * purpose: 获取用户当前余额
     * return:  返回用户账号总余额
     * author:longdada
     * write_time:2019/02/10 09:15
     */
    public function get_user_money_count()
    {
        $post_data=input();
        if($this->validates->scene('get_user_money_count')->check($post_data)){
            $where['id']=$post_data['id'];
            $rs_row=$this->user->where($where)->find();
            if(empty($rs_row)){
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("NOT_USER_INFO");
            }else{
                $rs_arr['code']=1;
                $rs_arr['data']=$rs_row['user_money'];
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:获取用户账号总积分
     * purpose: 获取用户当前积分
     * return:  返回用户账号总积分 
     * author:longdada
     * write_time:2019/02/10 18:15
     */
    public function get_user_score_count()
    {
        $post_data=input();
        if($this->validates->scene('get_user_score_count')->check($post_data)){
            $where['id']=$post_data['id'];
            $rs_row=$this->user->where($where)->find();
            if(empty($rs_row)){
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("NOT_USER_INFO");
            }else{
                $rs_arr['code']=1;
                $rs_arr['data']=$rs_row['score'];
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:保存用户信息更新
     * purpose: 后台程序更新用户信息接口
     * return:  返回更新状态
     * author:longdada
     * write_time:2019/02/10 09:15
     */
    public function save_user_update($up_data)
    {
        $rs_st=$this->user->allowField(true)->isUpdate(true)->save($up_data);
        if($rs_st!==false){
            $rs_arr['code']=1;
            $rs_arr['msg']=lang("SAVE_SUCCESS");
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=lang("SAVE_ERROR");
        }
        return $rs_arr;
    }

}
