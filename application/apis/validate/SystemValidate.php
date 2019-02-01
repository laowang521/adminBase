<?php
namespace app\common\validate;
use think\Validate;
class SystemValidate extends Validate
{   
    /* name:管理员验证规格
     * purpose: 对管理员模型收到的数据进行验证
     * return:  无
     * author:longdada
     * write_time:2019/01/22 22:30
     */
    protected $rule = [
        'token|token'  => 'require',
        'app_id|APPID'  => 'require',
        'app_secret|APPSECTET'  => 'require'
    ];
    /* name:管理员验证消息
     * purpose: 对管理员验证错误信息进行定制 
     * return:  无
     * author:longdada
     * write_time:2019/01/22 22:31
     */
    protected $message = [
    ];
    /* name:管理员验证场景
     * purpose: 按照不同的场景定义不同的验证规则更加灵活 
     * return:  无
     * author:longdada
     * write_time:2019/01/22 22:32
     */
    protected $scene = [
        'generate_api_token'  =>  ['app_id','app_secret'],
        'apis_base'  =>  ['token'],
    ];
}
