<?php
namespace app\index\controller;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
use think\Controller;
class IndexController extends Controller
{
    public function _initialize()
    {
        parent::_initialize();
    }
    public function Index()
    {
       return "犇犇科技 棒棒哒";
    }
}
