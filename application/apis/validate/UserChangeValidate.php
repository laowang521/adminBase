<?php
namespace app\apis\validate;
use think\Validate;
class UserChangeValidate extends Validate
{   
    /* name:用户账户明细验证规则
     * purpose: 对用户的账户明细进行验证
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $rule = [
        'id|ID'  => 'require|number|gt:0',
        'user_id|用户ID'  => 'require|number|gt:0',
        'acc_type|账户类型'  => 'require|in:1,2',
        'account|提现账号'  => 'require|length:6,50',
        'change_money|金额'  => 'require|number|gt:0'
    ];
    /* name:自定义验证规则错误信息
     * purpose: 自定义验证规则错误信息
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $message = [
    ];
    /* name:账户明细验证场景
     * purpose: 按照不同的场景定义不同的验证规则更加灵活 
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $scene = [
        'save_user_money_add'  =>  ['user_id','change_money','acc_type'],
        'save_user_money_withdraw'  =>  ['user_id','change_money','acc_type','account'],
        'get_user_money_log'  =>  ['user_id'],
        'get_user_score_log'  =>  ['user_id'],
        'save_user_money_confirm'  =>  ['id']
    ];
}
