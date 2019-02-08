<?php
namespace app\apis\validate;
use think\Validate;
class UserMsgValidate extends Validate
{   
    /* name:用户收货地址验证规则
     * purpose: 对用户的收货地址进行验证
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $rule = [
        'id|消息ID'  => 'require|number|gt:0',
        'user_id|用户ID'  => 'require|number|gt:0',
    ];
    /* name:自定义验证规则错误信息
     * purpose: 自定义验证规则错误信息
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $message = [
    ];
    /* name:收货地址验证场景
     * purpose: 按照不同的场景定义不同的验证规则更加灵活 
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $scene = [
        'get_system_msg_list'  =>  ['user_id'],
        'get_system_msg_details'  =>  ['id'],
        'get_system_msg_del'  =>  ['id']
    ];
}
