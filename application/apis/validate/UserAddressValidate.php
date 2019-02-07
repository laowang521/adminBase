<?php
namespace app\common\validate;
use think\Validate;
class UserAddressValidate extends Validate
{   
    /* name:用户收货地址验证规则
     * purpose: 对用户的收货地址进行验证
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $rule = [
        'id|收货地址ID'  => 'require|number|gt:0',
        'user_id|用户ID'  => 'require|number|gt:0',
        'name|姓名'  => 'require|chsAlpha',
        'mobile|联系电话'  => 'require|regex:/^[1][3,4,5,7,8][0-9]{9}$/',
        'Province|省份'  => 'require|number|gt:0',
        'city|城市'  => 'require|number|gt:0',
        'district|县区'  => 'require|number|gt:0',
        'is_default|是否默认'  => 'require|in:0,1',
        'address|详细地址'  => 'require|length:6,99'
    ];
    /* name:自定义验证规则错误信息
     * purpose: 自定义验证规则错误信息
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $message = [
        'Province'=>'请选择省份',
        'city'=>'请选择城市',
        'district'=>'请选择县区'
    ];
    /* name:收货地址验证场景
     * purpose: 按照不同的场景定义不同的验证规则更加灵活 
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $scene = [
        'get_address_list'  =>  ['user_id'],
        'save_address_add'  =>  ['user_id','name','mobile','Province','city','district','address'],
        'get_address_row'  =>  ['id'],
    ];
}
