<?php
namespace app\apis\model\logic;
class RegionModel
{
    /* name:逻辑层初始化方法
     * purpose: 初始化数据库层管理员模型对象
     * return:  无
     * author:longdada
     * write_time:2019/01/22 22:00
     */
    public function __construct()
    {
        $this->system=model('db.System');
    }
    /* name:生成apitoken
     * purpose: 生成接口凭证
     * return:  返回生成结果
     * author:longdada
     * write_time:2019/01/22 21:51
     */
    public function generate_api_token()
    {
        $post_data=input();
        $validate=validate('System');
        if($validate->scene('generate_api_token')->check($post_data)){
            $conf=config('token');
            if($post_data['app_id']==$conf['app_id']&&$post_data['app_secret']==$conf['app_secret']){
                $time=floor(time()/300);
                $rand_str=generate_random_str(0,52,16);
                $token=md5(MD5($rand_str.$conf['app_id'].$time.$rand_str.$conf['app_secret'].$conf['app_suffix']));
                $rs_data['rand_str']=$rand_str;
                $rs_data['time']=$time;
                cache($token,$rs_data, 300);
                $rs_arr['code']=1;
                $rs_arr['data']=$rs_data;
                $rs_arr['token']=$token;
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']='appid或appsecret不正确';
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$validate->getError();
        }
        return $rs_arr;
        return false;
    }
}
