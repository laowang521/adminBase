<?php

namespace app\apis\model\service;
class RegionModel 
{
    /* name:初始化函数
     * purpose: 系统模型初始化方法,初始化系统逻辑层类对象.
     * return:  无
     * author:longdada
     * write_time:2019/01/30 14:50
     */
    public function __construct()
    {
        $this->system=model('logic.System');
    }
    /* name:生成apitoken
     * purpose: 生成接口凭证
     * return:  返回生成结果
     * author:longdada
     * write_time:2019/01/22 21:51
     */
    public function generate_api_token()
    {
        return  $this->system-> generate_api_token();
    }
}
