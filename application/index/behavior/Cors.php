<?php 
namespace app\common\model\db;

class  Cors 
{
    public function responseSend()
    {   
        header('Access-Control-Allow-Origin:*');     
        header('Access-Control-Allow-Methods:*');  
        header('Access-Control-Allow-Headers:*');
        header('Access-Control-Allow-Credentials:false');
    }    
}