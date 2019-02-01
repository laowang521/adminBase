<?php
/* name:获取随机字符串函数
 * purpose: 按照不同的场景定义不同的验证规则更加灵活 
 * param1: 获取随机字符串随机内容的开始位置
 * param2: 获取随机字符串随机内容的结束位置
 * param3: 获取随机字符串的长度
 * return:  无
 * author:longdada
 * write_time:2019/01/22 22:36
 */
function generate_random_str($start=0,$end=54,$str_len=16){
	$base_arr=[
			'1','a','b','c','d','e','f','g','h','j',
			'k','m','n','p','q','r','s','t','u','w',
			'x','y','z','A','B','C','D','E','F','G',
			'H','J','K','L','M','N','P','Q','R','S',
			'T','U','W','X','Y','Z','0','1','2','3',
			'4','5','6','7','8','9'];
	$rs_str='';
	for($i=0;$i<$str_len;$i++){
		$key=rand($start, $end);
		$rs_str.=$base_arr[$key];	
	}
	return $rs_str;
}
/* name:生成密码密文
 * purpose: 获取一个随机字符串对原密码进行加密
 * param1: 源密码
 * return:  生成的密码密文和随机字符串
 * author:longdada
 * write_time:2019/01/22 22:36
 */
function generate_passwd($pass){
	$rand_str=generate_random_str(0,54,6);
	$rs_arr['pass']=md5("**&%^%@!".md5($pass).$rand_str);
	$rs_arr['pass_code']=$rand_str;
	return $rs_arr;
}
/* name:生成比对密文
 * purpose: 用用户输入的密码和数据库存储的密码随机字符串重新生成密文 并返回用于比对
 * param1: 客户录入的密码 
 * param2: 生成密码时附加的随机字符串
 * return:  返回输入密码生成的密文 
 * author:longdada
 * write_time:2019/01/22 22:36
 */
function diff_passwd($pass,$code){
	$rs_arr=md5("**&%^%@!".md5($pass).$code);
	return $rs_arr;
}
/* name:获取token
 * purpose: 获取请求头中的用户凭证
 * return:  返回获取的值 
 * author:longdada
 * write_time:2019/01/22 22:36
 */
function get_token(){
	return request()->header('A-Token');
}
/* name:上传图片
 * purpose: 文件对象形式图片上传
 * param1: 图片对象 
 * return:  返回上传后保存的路径
 * author:longdada
 * write_time:2019/01/31 14:36
 */
function upload_file_object($file){
	$upload_url='./static/uploads/'. date("Ym")."/";
	chmod($upload_url,0777);
	if(!is_dir($upload_url))mkdir($upload_url,0777,true);
	$file_name=date("YmdHis").generate_random_str(3,52,8);
	$info=$file->move($upload_url,$file_name);
	$rs_url=str_replace("./", "/", $upload_url).$info->getSaveName();
	chmod(".".$rs_url,0777);
	return  $rs_url;
}
/* name:上传图片
 * purpose: BASE64形式图片上传
 * param1: base64 图片数据 
 * return:  返回上传后保存的路径
 * author:longdada
 * write_time:2019/02/02 7:45
 */
function upload_file_base64($base64_data){
	$base64=$base64_data;
	$base64_image = str_replace(' ', '+', $base64);
	//post的数据里面，加号会被替换为空格，需要重新替换回来，如果不是post的数据，则注释掉这一行
	preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image, $result);
	$file_name=date("YmdHis").generate_random_str(3,52,8).'.'.$result[2];
	$upload_url='./static/uploads/'. date("Ym")."/";
	if(!is_dir($upload_url))mkdir($upload_url,0777,true);
	//服务器文件存储路径
	file_put_contents($upload_url.$file_name, base64_decode(str_replace($result[1], '', $base64_image)));
	return str_replace('./', '/', $upload_url.$file_name);
}
/* name:上传图片
 * purpose: 文件对象形式图片上传
 * param1: 原图的url 
 * param2: 缩略图最大宽度 
 * param3: 缩略图最大高度
 * param3: 是否覆盖原图
 * return:  返回上传后保存的路径
 * author:longdada
 * write_time:2019/01/31 16:36
 */
function image_thumb($img_url,$width=600,$height=600,$is_cover=true){
	$image = \think\Image::open('.'.$img_url);
	if($is_cover){
		$image->thumb($width,$height,1)->save('.'.$img_url); 
		$rs_url=$img_url;//
	}else{
		$upload_url='./static/uploads/'. date("Ym")."/";
		chmod($upload_url,0777);
		if(!is_dir($upload_url))mkdir($upload_url,0777,true);
		$file_name=date("YmdHis").generate_random_str(3,52,6).".".$image->type();
		$save_push=$upload_url.$file_name;
		$image->thumb($width,$height,1)->save($save_push); 
		$t_url=str_replace("./", "/", $save_push);
		$rs_url['s_url']=$img_url;//返回的原图地址
		$rs_url['t_url']=$t_url;//返回的缩略图地址
	}
	return $rs_url;
}