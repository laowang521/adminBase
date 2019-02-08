<?php
namespace app\apis\validate;
use think\Validate;
class UserBrowseValidate extends Validate
{   
    /* name:浏览记录验证规则
     * purpose: 对浏览记录进行验证
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $rule = [
        'user_id|用户ID'  => 'require|number|gt:0',
        'type|类型'  => 'require|in:1,2,3,4',
        'browse_id|被浏览ID'  => 'require|number|gt:0',
    ];
    /* name:自定义验证规则错误信息
     * purpose: 自定义验证规则错误信息
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $message = [
    ];
    /* name:浏览记录验证场景
     * purpose: 按照不同的场景定义不同的验证规则更加灵活 
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $scene = [
        'get_browse_list'  =>  ['user_id','type'],
        'save_browse_add'  =>  ['user_id','type','browse_id'],
        'save_browse_del'  =>  ['user_id','type','browse_id']
    ];
}
