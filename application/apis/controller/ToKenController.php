<?php
namespace app\apis\controller;
use think\Controller;
class ToKenController extends Controller
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
        $this->system=model('service.System');
    }
    /* name:生成token
     * purpose: 所有接口请求前生成token
     * return:  返回生成的token
     * author:longdada
     * write_time:2019/01/29 14:40
     */
    public function generateApiToken()
    {
        $rs_data=$this->system->generate_api_token();
        return json($rs_data);
    }
}
