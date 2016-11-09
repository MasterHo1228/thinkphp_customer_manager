<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016.11.03
 * Time: 19:44
 */
namespace Admin\Controller;
use Think\Controller;
class IframeController extends Controller {
    public function welcome(){
        $Model = M();
        $usrID = session('user.usrID');

        $sql = "SELECT LastLoginTime,LastLoginIP FROM AdminUserLoginLog WHERE AdminID={$usrID} ORDER BY LastLoginTime DESC LIMIT 1,1 ;";
        $data = $Model->query($sql);
        $this->assign('loginTime',$data[0]['lastlogintime']);
        $this->assign('loginIpAddr',$data[0]['lastloginip']);
        $this->display();
    }

    public function CustomerList(){
        $model = D('customer');
        $data = $model->getCustomerList();
        $this->assign('customerList',$data);
        $this->display('customer_list');
    }

    public function CustomerInfo(){
        if (IS_GET){
            $model = D('customer');
            $id = I('get.ID/d');
            $data = $model->getCustomerInfo($id);

            $this->assign('data',$data);
            $this->display('customer_info');
        } else {
            $this->error('非法操作！');
        }
    }

    public function _empty(){
        $this->error('非法操作！','');
    }
}