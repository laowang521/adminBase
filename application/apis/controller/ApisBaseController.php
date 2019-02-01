<?php
namespace app\apis\controller;
use think\Controller;
use think\Response;
class ApisBaseController extends Controller
{
    /* name:初始化方法
     * purpose: Api模块登录基础类
     * return:  无
     * author:longdada
     * write_time:2019/01/29 08:05
     */
    public function _initialize()
    {
        parent::_initialize();
        $post_data['token']=get_token();
        $validate=validate('System');
        if(!$validate->scene('apis_base')->check($post_data)){
            $rs_arr['code']=2;
            $rs_arr['msg']=$validate->getError();
            Response::create($rs_arr, 'json')->send();
            exit;
        }else{
            $token=cache($post_data['token']);
            if(empty($token)){
                $rs_arr['code']=3;
                $rs_arr['msg']=lang("TOKEN_ERROR");
                Response::create($rs_arr, 'json')->send();
                exit;
            }else{
                cache($post_data['token'],$token, 600);
            }
        }
    }
}
