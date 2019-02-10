<?php

namespace app\apis\model\service;
class UserModel 
{
    /* name:初始化函数
     * purpose: 用户模型初始化方法,初始化用户逻辑层方法对象.
     * return:  无
     * author:longdada
     * write_time:2019/01/30 14:47
     */
    public function __construct()
    {
        $this->user=model('logic.User');
    }
    /* name:验证手机号
     * purpose: 验证手机号是否合法
     * return:  返回验证结果结果
     * author:longdada
     * write_time:2019/01/30 14:24
     */
    public function validate_mobile()
    {
        return  $this->user->validate_mobile();
    }
    /* name:发送短信验证码
     * purpose: 发送短信验证码
     * return:  返回发送结果
     * author:longdada
     * write_time:2019/01/29 18:12
     */
    public function send_sms()
    {
        return  $this->user->send_sms();
    }
    /* name:第三方登录/注册
     * purpose: 用户注册方法
     * return:  返回注册结果
     * author:longdada
     * write_time:2019/01/30 15:10
     */
    public function register()
    {
        return  $this->user->register();
    }
    /* name:登录(手机+密码登录)
     * purpose: 用户密码登录接口
     * return:  返回登录结果
     * author:longdada
     * write_time:2019/01/29 14:09
     */
    public function passwd_login()
    {
        return  $this->user->passwd_login();
    }
    /* name:登录(手机+验证码登录)
     * purpose: 用户验证码登录接口
     * return:  返回登录结果
     * author:longdada
     * write_time:2019/01/30 9:29
     */
    public function code_login()
    {
        return  $this->user->code_login();
    }
    /* name:忘记/找回密码
     * purpose: 用户忘记密码接口
     * return:  返回重置密码结果
     * author:longdada
     * write_time:2019/01/30 9:41
     */
    public function forget_passwd()
    {
        return  $this->user->forget_passwd();
    }
    /* name:更换手机号
     * purpose: 用户更换手机号接口
     * return:  返回更换结果
     * author:longdada
     * write_time:2019/01/30 10:01
     */
    public function bind_mobile()
    {
        return  $this->user->bind_mobile();
    }
    /* name:修改密码
     * purpose: 修改密码
     * return:  返回修改结果
     * author:longdada
     * write_time:2019/01/30 10:01
     */
    public function reset_passwd()
    {
        return  $this->user->reset_passwd();
    }
    /* name:获取个人资料信息
     * purpose: 获取用户信息接口
     * return:  返回更换结果
     * author:longdada
     * write_time:2019/01/30 10:01
     */
    public function get_user_info()
    {
        return  $this->user->get_user_info();
    }
    /* name:更改个人资料信息
     * purpose: 保存用户信息接口
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/01/31 10:01
     */
    public function save_user_info()
    {
        return  $this->user->save_user_info();
    }
    /* name:上传会员头像(文件对象形式)
     * purpose: 上传用户头像
     * return:  返回头像保存地址
     * author:longdada
     * write_time:2019/01/31 10:01
     */
    public function upload_img_file_user()
    {
        return  $this->user->upload_img_file_user();
    }
    /* name:上传会员头像(base64数据流形式)
     * purpose: 上传用户头像
     * return:  返回头像保存地址
     * author:longdada
     * write_time:2019/01/31 16:49
     */
    public function upload_img_base64_user()
    {
        return  $this->user->upload_img_base64_user();
    }
    /* name:获取用户id获取用户信息
     * purpose: 获取用户id获取用户信息
     * param1: 用户id
     * return:  返回用户信息
     * author:longdada
     * write_time:2019/02/03 08:49
     */
    public function get_user_row($user_id)
    {
        return  $this->user->get_user_row($user_id);
    }
    /* name:设置用户默认收货地址
     * purpose: 设置用户的默认收货地址
     * param1: 用户id
     * param2: 地址id
     * return:  返回设置结果
     * author:longdada
     * write_time:2019/02/03 08:49
     */
    public function set_address_default($user_id,$address_id)
    {
        return  $this->user->set_address_default($user_id,$address_id);
    }
    /* name:设置用户默认收货地址
     * purpose: 用户在收货地址列表页设置默认收货地址
     * return:  返回设置结果
     * author:longdada
     * write_time:2019/02/03 08:49
     */
    public function user_set_address_default()
    {
        return  $this->user->user_set_address_default();
    }
    /* name:获取用户账号总余额
     * purpose: 保存会员签到记录
     * return:  返回用户账号总余额
     * author:longdada
     * write_time:2019/02/10 09:15
     */
    public function get_user_money_count()
    {
        return $this->user->get_user_money_count();
    }
}
