<?php
namespace app\apis\controller;
class UserController extends ApisBaseController
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
        $this->user=model('service.User');
        $this->address=model('service.UserAddress');
        $this->user_msg=model('service.UserMsg');
        $this->user_follow=model('service.UserFollow');
        $this->user_collect=model('service.UserCollect');
        $this->user_browse=model('service.UserBrowse');
        $this->user_feedback=model('service.UserFeedback');
        $this->user_sign=model('service.UserSign');
        $this->user_change=model('service.UserChange');
        $this->region=model('service.Region');
        $this->system=model('service.System');
    }
    /* name:获取APP系统版本号
     * purpose: 获取APP系统版本号用于更新
     * return:  返回版本号结果是否需要进行APK更新
     * author:longdada
     * write_time:2019/02/08 20:11
     */
    public function getSystemVersion()
    {
        $rs_data['code']=1;
        $rs_arr['version']='1.000';
        $rs_arr['is_update_apk']=0;
        $rs_data['data']=$rs_arr;
        return json($rs_data);
    }
    /* name:电话咨询(获取平台联系方式)
     * purpose: 获取平台联系方式
     * return:  返回平台电话号码结果
     * author:longdada
     * write_time:2019/02/09 22:20
     */
    public function getSystemMobile()
    {
        $rs_data['code']=1;
        $rs_data['data']='0371-65742335';
        return json($rs_data);
    }
    /* name:验证手机号
     * purpose: 验证手机号是否合法
     * return:  返回验证结果结果
     * author:longdada
     * write_time:2019/01/30 14:24
     */
    public function validateMobile()
    {
        $rs_data=$this->user->validate_mobile();
        return json($rs_data);
    }
    /* name:发送短信方法
     * purpose: 登录控制器发送短信方法
     * return:  返回发送结果
     * author:longdada
     * write_time:2019/01/30 9:09
     */
    public function sendSms()
    {
        $rs_data=$this->user->send_sms();
        return json($rs_data);
    }
    /* name:注册方法
     * purpose: 登录控制器注册方法
     * return:  返回注册结果
     * author:longdada
     * write_time:2019/01/30 15:10
     */
    public function register()
    {
        $rs_data=$this->user->register();
        return json($rs_data);
    }
    /* name:密码登录方法
     * purpose: 用户密码登录接口
     * return:  返回登录结果
     * author:longdada
     * write_time:2019/01/29 14:09
     */
    public function login()
    {
        $rs_data=$this->user->passwd_login();
        return json($rs_data);
    }
    /* name:验证码登录方法
     * purpose: 用户验证码登录接口
     * return:  返回登录结果
     * author:longdada
     * write_time:2019/01/30 9:29
     */
    public function codeLogin()
    {
        $rs_data=$this->user->code_login();
        return json($rs_data);
    }
    /* name:忘记密码方法
     * purpose: 用户忘记密码接口
     * return:  返回重置密码结果
     * author:longdada
     * write_time:2019/01/30 9:41
     */
    public function forgetPasswd()
    {
        $rs_data=$this->user->forget_passwd();
        return json($rs_data);
    }
    /* name:更换手机号
     * purpose: 用户更换手机号接口
     * return:  返回更换结果
     * author:longdada
     * write_time:2019/01/30 10:01
     */
    public function bindMobile()
    {
        $rs_data=$this->user->bind_mobile();
        return json($rs_data);
    }
    /* name:修改密码
     * purpose: 修改密码
     * return:  返回修改结果
     * author:longdada
     * write_time:2019/01/30 10:01
     */
    public function resetPasswd()
    {
        $rs_data=$this->user->reset_passwd();
        return json($rs_data);
    }
    /* name:获取个人资料信息
     * purpose: 获取用户信息接口
     * return:  返回更换结果
     * author:longdada
     * write_time:2019/01/30 10:01
     */
    public function getUserInfo()
    {
        $rs_data=$this->user->get_user_info();
        return json($rs_data);
    }
    /* name:保存个人资料信息
     * purpose: 保存用户信息接口
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/01/30 10:01
     */
    public function saveUserInfo()
    {
        $rs_data=$this->user->save_user_info();
        return json($rs_data);
    }
    /* name:上传用户头像
     * purpose: 上传用户头像
     * return:  返回头像保存地址
     * author:longdada
     * write_time:2019/01/31 10:01
     */
    public function uploadUserImg()
    {
        $rs_data=$this->user->upload_img_base64_user();
        return json($rs_data);
    }
    /* name:获取收货地址列表
     * purpose: 根据用户ID获取用户收货地址列表
     * return:  返回列表数据
     * author:longdada
     * write_time:2019/02/02 08:29
     */
    public function getAddressList()
    {
        $rs_data=$this->address->get_address_list();
        return json($rs_data);
    }
    /* name:获取一行收货地址
     * purpose: 根据用户ID获取用户收货地址
     * return:  返回用户收货地址数据
     * author:longdada
     * write_time:2019/02/02 08:29
     */
    public function getAddressRow()
    {
        $rs_data=$this->address->get_address_row();
        return json($rs_data);
    }
    /* name:添加单个收货地址
     * purpose: 保存单个收货地址添加
     * return:  返回添加结果
     * author:longdada
     * write_time:2019/02/02 22:34
     */
    public function saveAddressAdd()
    {
        $rs_data=$this->address->save_address_add();
        return json($rs_data);
    }
    /* name:省市区三级联动接口
     * purpose: 获取下级地区列表
     * return:  返回地区列表
     * author:longdada
     * write_time:2019/02/02 23:39
     */
    public function getRegionList()
    {
        $rs_data=$this->region->get_region_list();
        return json($rs_data);
    }
    /* name:编辑单个收货地址
     * purpose: 保存单个收货地址编辑
     * return:  返回编辑结果
     * author:longdada
     * write_time:2019/02/08 08:45
     */
    public function saveAddressEdit()
    {
        $rs_data=$this->address->save_address_edit();
        return json($rs_data);
    }
    /* name:删除收货地址
     * purpose: 删除收货地址
     * return:  返回删除结果
     * author:longdada
     * write_time:2019/02/08 09:10
     */
    public function saveAddressDel()
    {
        $rs_data=$this->address->save_address_del();
        return json($rs_data);
    }
    /* name:设置默认收货地址
     * purpose: 设置默认收货地址
     * return:  返回设置结果
     * author:longdada
     * write_time:2019/02/08 09:20
     */
    public function setAddressDefault()
    {
        $rs_data=$this->user->user_set_address_default();
        return json($rs_data);
    }
    /* name:获取系统消息列表
     * purpose: 获取系统消息列表
     * return:  返回列表记录
     * author:longdada
     * write_time:2019/02/08 10:20
     */
    public function getSystemMsgList()
    {
        $rs_data=$this->user_msg->get_system_msg_list();
        return json($rs_data);
    }
    /* name:获取系统消息详情
     * purpose: 获取某一条系统消息的详情
     * return:  返回一条记录
     * author:longdada
     * write_time:2019/02/08 10:20
     */
    public function getSystemMsgDetails()
    {
        $rs_data=$this->user_msg->get_system_msg_details();
        return json($rs_data);
    }
    /* name:系统消息删除
     * purpose: 系统消息单个或批量删除
     * return:  返回删除结果
     * author:longdada
     * write_time:2019/02/08 10:20
     */
    public function getSystemMsgDel()
    {
        $rs_data=$this->user_msg->get_system_msg_del();
        return json($rs_data);
    }
    /* name:我的关注列表
     * purpose: 获取我关注的店铺,商铺,文章,用户列表
     * return:  返回列表数据
     * author:longdada
     * write_time:2019/02/08 12:10
     */
    public function getFollowList()
    {
        $rs_data=$this->user_follow->get_follow_list();
        return json($rs_data);
    }
    /* name:添加关注
     * purpose: 保存添加关注
     * return:  返回关注结果
     * author:longdada
     * write_time:2019/02/08 14:17
     */
    public function saveFollowAdd()
    {
        $rs_data=$this->user_follow->save_follow_add();
        return json($rs_data);
    }
    /* name:取消关注
     * purpose: 保存取消关注
     * return:  返回取消关注结果
     * author:longdada
     * write_time:2019/02/08 16:40
     */
    public function saveFollowDel()
    {
        $rs_data=$this->user_follow->save_follow_del();
        return json($rs_data);
    }
    /* name:我的收藏列表
     * purpose: 获取我收藏的店铺,商铺,文章,用户列表
     * return:  返回列表数据
     * author:longdada
     * write_time:2019/02/08 17:10
     */
    public function getCollectList()
    {
        $rs_data=$this->user_collect->get_collect_list();
        return json($rs_data);
    }
    /* name:添加收藏
     * purpose: 保存我收藏的店铺,商铺,文章,用户
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/02/08 17:20
     */
    public function saveCollectAdd()
    {
        $rs_data=$this->user_collect->save_collect_add();
        return json($rs_data);
    }
    /* name:删除收藏
     * purpose: 保存我收藏的店铺,商铺,文章,用户
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/02/08 17:20
     */
    public function saveCollectDel()
    {
        $rs_data=$this->user_collect->save_collect_del();
        return json($rs_data);
    }
    /* name:我的收藏列表
     * purpose: 获取我收藏的店铺,商铺,文章,用户列表
     * return:  返回列表数据
     * author:longdada
     * write_time:2019/02/08 17:10
     */
    public function getBrowseList()
    {
        $rs_data=$this->user_browse->get_browse_list();
        return json($rs_data);
    }
    /* name:添加浏览记录
     * purpose: 保存我浏览的商品,文章
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/02/08 17:20
     */
    public function saveBrowseAdd()
    {
        $rs_data=$this->user_browse->save_browse_add();
        return json($rs_data);
    }
    /* name:删除收藏
     * purpose: 保存我收藏的店铺,商铺,文章,用户
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/02/08 17:20
     */
    public function saveBrowseDel()
    {
        $rs_data=$this->user_browse->save_browse_del();
        return json($rs_data);
    }
    /* name:保存建议反馈
     * purpose: 保存建议反馈
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/02/08 21:20
     */
    public function saveFeedback()
    {
        $rs_data=$this->user_feedback->save_feedback();
        return json($rs_data);
    }
    /* name:会员连续签到天数
     * purpose: 会员连续签到天数(获取签到天数)
     * return:  返回查询结果
     * author:longdada
     * write_time:2019/02/10 08:35
     */
    public function getUserSignCount()
    {
        $rs_data=$this->user_sign->get_user_sign_count();
        return json($rs_data);
    }
    /* name:会员签到
     * purpose: 保存会员签到记录
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/02/10 09:15
     */
    public function saveUserSignAdd()
    {
        $rs_data=$this->user_sign->save_user_sign_add();
        return json($rs_data);
    }
    /* name:获取用户账号总余额
     * purpose: 保存会员签到记录
     * return:  返回用户账号总余额
     * author:longdada
     * write_time:2019/02/10 09:15
     */
    public function getUserMoneyCount()
    {
        $rs_data=$this->user->get_user_money_count();
        return json($rs_data);
    }
    /* name:账户余额充值
     * purpose: 保存会员账户余额充值
     * return:  返回保存结果
     * author:longdada
     * write_time:2019/02/10 09:55
     */
    public function saveUserMoneyAdd()
    {
        $rs_data=$this->user_change->save_user_money_add();
        return json($rs_data);
    }
    /* name:充值支付确认
     * purpose: 充值支付成功更新用户余额
     * return:  返回更新结果
     * author:longdada
     * write_time:2019/02/10 10:55
     */
    public function saveUserMoneyConfirm()
    {
        $rs_data=$this->user_change->save_user_money_confirm();
        return json($rs_data);
    }
}
