<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function login(){
        if (IS_POST){
            $userName=I('post.usrName');
            $password=I('post.usrPasswd');
            $userObj=D('adminuser');
            $where['Name']=$userName;
            $tmp_password=$userObj->where($where)->getField('Password');
            $tmp_salt=$userObj->where($where)->getField('salt');
            if(md5($password.$tmp_salt)==$tmp_password){
                $userID=$userObj->where($where)->getField('ID');

                $loginLog = D("adminuserloginlog");
                $data['AdminID']=$userID;
                $data['LastLoginTime']=date('Y-m-d H:i:s');
                $data['LastLoginIP']=I('server.REMOTE_ADDR');
                $loginLog->add($data);

                $_SESSION['usrID']=$userID;
                $_SESSION['usrName']=$userName;
                $_SESSION['usrType']=$userObj->where($where)->getField('UserType');

                $this->success('登录成功！',U('main'));
            }else{
                $this->error('用户名或密码错误！！');
            }
            die;
        } else {
            $this->display("login");
        }
    }

    public function main(){
        $usrName=I('session.usrName/s');
        $usrType=I('session.usrType/d');
        $this->assign('usrName',$usrName);
        $this->assign('usrType',$usrType);
        $this->display('main');
    }

    public function logout(){
        $_SESSION = null;
        session_destroy();
        //跳转
        $this->success('登出系统成功！',U('login'));
    }
}