<?php
namespace app\common\validate;
use think\Validate;
class UserValidate extends Validate
{   
    /* name:用户验证规格
     * purpose: 对用户模型收到的数据进行验证
     * return:  无
     * author:longdada
     * write_time:2019/01/22 22:30
     */
    protected $rule = [
        'id|用户ID'  => 'require|number|gt:0',
        'send_type|发送类型'  => 'require',
        'user_login|账号'  => 'require|unique:user|regex:/^[1][3,4,5,7,8][0-9]{9}$/',
        'passwd|密码'  => 'require|chsDash|length:6,34',
        'head_img|上传头像'  => 'file|fileExt:jpg,png.gif',
        'address_id|默认收货地址'  => 'require|number|gt:0',
        'repasswd|确认密码'  => 'chsDash|length:6,34|confirm:passwd'
    ];
    /* name:用户验证消息
     * purpose: 对用户验证错误信息进行定制 
     * return:  无
     * author:longdada
     * write_time:2019/01/22 22:31
     */
    protected $message = [
        'user_login.regex' => '登录名必须为手机号格式',
        'head_img.fileSize'=>'上传文件大小超限',
        'head_img.fileExt'=>'上传文件格式错误',
        'repasswd.confirm' => '确认密码和密码不一致'
    ];
    /* name:用户验证场景
     * purpose: 按照不同的场景定义不同的验证规则更加灵活 
     * return:  无
     * author:longdada
     * write_time:2019/01/22 22:32
     */
    protected $scene = [
        'validate_mobile'  =>  ['send_type'],
        'validate_mobile_1'  =>  ['user_login'],
        'validate_mobile_2'  =>  ['user_login' => 'require|regex:/^[1][3,4,5,7,8][0-9]{9}$/'],
        'send_sms'  =>  ['user_login' => 'require|regex:/^[1][3,4,5,7,8][0-9]{9}$/'],
        'register'  =>  ['user_login','passwd'],
        'passwd_login'  =>  ['user_login'=> 'require|regex:/^[1][3,4,5,7,8][0-9]{9}$/','passwd'],
        'code_login'  =>  ['user_login'=> 'require|regex:/^[1][3,4,5,7,8][0-9]{9}$/'],
        'forget_passwd'  =>  ['user_login'=> 'require|regex:/^[1][3,4,5,7,8][0-9]{9}$/','passwd'],
        'bind_mobile'  =>  ['id','user_login'],
        'reset_passwd'  =>  ['id','passwd'],
        'get_user_info'  =>  ['id'],
        'save_user_info'  =>  ['id'],
        'upload_img_file_user'  =>  ['id','head_img'],
        'upload_img_base64_user'  =>  ['id','head_img'=>"require"],
        'user_set_address_default'  =>  ['id','address_id'],
    ];
}
