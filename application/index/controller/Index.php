<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\Goods;
use think\Request;
use think\Db;
class Index extends Controller
{
	/**
	 *@content 商城首页
	 *@return  mixed
	 *@author  tonglijing
	 *@time    2018-8-1
	 */
    public function index()
    {
        $goods = new Goods;
        $data = $goods->showNum(6);
        return view('index',['data'=>$data]);
    }

    /**
	 *@content 商城首页--蔬果热卖页面
	 *@return  mixed
	 *@author  tonglijing
	 *@time    2018-8-1
	 */
    public function hot()
    {
    	$goods = new Goods;
        $data = Db::table('grx_goods')->paginate(8);
    	return view('hot',['data'=>$data]);
    }

    /**
	 *@content 商城首页--全部产品页面
	 *@return  mixed
	 *@author  tonglijing
	 *@time    2018-8-1
	 */
    public function produ()
    {
    	$goods = new Goods;
        $data = Db::table('grx_goods')->paginate(8);
    	return view('produ',['data'=>$data]);
    }

    /**
	 *@content 商城首页--橘子页面
	 *@return  mixed
	 *@author  tonglijing
	 *@time    2018-8-1
	 */
    public function orange()
    {
    	return $this->fetch('orange');
    }


    /**
	 *@content 商城首页--最新资讯页面
	 *@return  mixed
	 *@author  tonglijing
	 *@time    2018-8-1
	 */
    public function consult()
    {
    	return $this->fetch('consult');
    }


    /**
	 *@content 商城首页--联系我们页面
	 *@return  mixed
	 *@author  tonglijing
	 *@time    2018-8-1
	 */
    public function touch()
    {
    	return $this->fetch('touch');
    }
     /**
	 *@content 果园推荐--商品详情
	 *@content 这里用到的是缓存技术
	 *@return  mixed
	 *@author  xuda
	 *@time    2018-8-1
	 */
	 public function detail()
	 {
	 	$request = Request::instance();
	 	$id = $request->get('id');
	 	$goods = new Goods;
	 	$data = $goods->detailData($id);
	 	ob_start();//开启缓冲区
	 	include "static/template.html";//引入模板
	 	$content = ob_get_contents();//获取缓冲区的内容
	 	file_put_contents("static/jintai.html", $content);//把获取到的内容发送到模板里，生成静态文件
	 }
}
