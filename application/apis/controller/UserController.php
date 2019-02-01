<?php
namespace app\apis\controller;
class UserController extends ApisBaseController
{
    /* name:初始化方法
     * purpose: 登录控制器初始化方法实例化服务层user类
     * return:  无
     * author:longdada
     * write_time:2019/01/29 14:04
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->user=model('service.User');
        $this->system=model('service.System');
    }
    /* name:验证手机号
     * purpose: 验证手机号是否合法
     * return:  返回验证结果结果
     * author:longdada
     * write_time:2019/01/30 14:24
     */
    public function validateMobile()
    {
        $rs_data=$this->user->validate_mobile();
        return json($rs_data);
    }
    /* name:发送短信方法
     * purpose: 登录控制器发送短信方法
     * return:  返回发送结果
     * author:longdada
     * write_time:2019/01/30 9:09
     */
    public function sendSms()
    {
        $rs_data=$this->user->send_sms();
        return json($rs_data);
    }
    /* name:注册方法
     * purpose: 登录控制器注册方法
     * return:  返回注册结果
     * author:longdada
     * write_time:2019/01/30 15:10
     */
    public function register()
    {
        $rs_data=$this->user->register();
        return json($rs_data);
    }
    /* name:密码登录方法
     * purpose: 用户密码登录接口
     * return:  返回登录结果
     * author:longdada
     * write_time:2019/01/29 14:09
     */
    public function login()
    {
        $rs_data=$this->user->passwd_login();
        return json($rs_data);
    }
    /* name:验证码登录方法
     * purpose: 用户验证码登录接口
     * return:  返回登录结果
     * author:longdada
     * write_time:2019/01/30 9:29
     */
    public function codeLogin()
    {
        $rs_data=$this->user->code_login();
        return json($rs_data);
    }
    /* name:忘记密码方法
     * purpose: 用户忘记密码接口
     * return:  返回重置密码结果
     * author:longdada
     * write_time:2019/01/30 9:41
     */
    public function forgetPasswd()
    {
        $rs_data=$this->user->forget_passwd();
        return json($rs_data);
    }
    /* name:更换手机号
     * purpose: 用户更换手机号接口
     * return:  返回更换结果
     * author:longdada
     * write_time:2019/01/30 10:01
     */
    public function bindMobile()
    {
        $rs_data=$this->user->bind_mobile();
        return json($rs_data);
    }
    /* name:修改密码
     * purpose: 修改密码
     * return:  返回修改结果
     * author:longdada
     * write_time:2019/01/30 10:01
     */
    public function resetPasswd()
    {
        $rs_data=$this->user->reset_passwd();
        return json($rs_data);
    }
    /* name:获取个人资料信息
     * purpose: 获取用户信息接口
     * return:  返回更换结果
     * author:longdada
     * write_time:2019/01/30 10:01
     */
    public function getUserInfo()
    {
        $rs_data=$this->user->get_user_info();
        return json($rs_data);
    }
    /* name:保存个人资料信息
     * purpose: 保存用户信息接口
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/01/30 10:01
     */
    public function saveUserInfo()
    {
        $rs_data=$this->user->save_user_info();
        return json($rs_data);
    }
    /* name:上传用户头像
     * purpose: 上传用户头像
     * return:  返回头像保存地址
     * author:longdada
     * write_time:2019/01/31 10:01
     */
    public function uploadUserImg()
    {
        $rs_data=$this->user->upload_img_base64_user();
        return json($rs_data);
    }
}
