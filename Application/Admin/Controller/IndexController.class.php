<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * Index控制类
 * Class IndexController
 * @package Admin\Controller
 */
class IndexController extends Controller {

    /**
     * 登录
     */
    public function login(){
        if (!session('?user')){
            if (IS_POST){
                $userName=I('post.usrName');
                $password=I('post.usrPasswd');
                $model=D('AdminUser');

                $rs = $model->CheckAccount($userName,$password);
                if ($rs){
                    $this->success('登录成功！',U('main'));
                } else {
                    $this->error('用户名或密码错误！！');
                }
                die;
            } else {
                $this->display("login");
            }
        } else {
            $this->redirect('main');
        }
    }

    /**
     * 加载系统主页面
     */
    public function main(){
        $usrName=session('user.usrName');
        $usrType=session('user.usrType');
        $this->assign('usrName',$usrName);
        $this->assign('usrType',$usrType);
        $this->display('main');
    }

    /**
     * 登出
     */
    public function logout(){
        session(null);
        session_destroy();
        //跳转
        $this->success('登出系统成功！',U('login'));
    }
}