<?php
namespace app\apis\validate;
use think\Validate;
class UserFeedbackValidate extends Validate
{   
    /* name:用户建议反馈验证规则
     * purpose: 对用户的建议反馈进行验证
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $rule = [
        'user_id|用户ID'  => 'require|number|gt:0',
        'content|建议内容'  => 'require',
    ];
    /* name:自定义验证规则错误信息
     * purpose: 自定义验证规则错误信息
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $message = [
    ];
    /* name:建议反馈验证场景
     * purpose: 按照不同的场景定义不同的验证规则更加灵活 
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $scene = [
        'save_feedback'  =>  ['user_id','content']
    ];
}
