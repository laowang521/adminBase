<?php
namespace app\apis\validate;
use think\Validate;
class UserCouponsValidate extends Validate
{   
    /* name:用户优惠券验证规则
     * purpose: 对用户的优惠券进行验证
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $rule = [
        'user_id|用户ID'  => 'require|number|gt:0',
        'type|类型'  => 'require|number|gt:0',
    ];
    /* name:自定义验证规则错误信息
     * purpose: 自定义验证规则错误信息
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $message = [
    ];
    /* name:优惠券验证场景
     * purpose: 按照不同的场景定义不同的验证规则更加灵活 
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $scene = [
        'get_coupons_list'  =>  ['user_id','type']
    ];
}
