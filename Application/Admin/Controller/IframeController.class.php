<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016.11.03
 * Time: 19:44
 */
namespace Admin\Controller;
use Think\Controller;

/**
 * iframe独立控制类
 * Class IframeController
 * @package Admin\Controller
 */
class IframeController extends Controller {

    /**
     * 加载欢迎页
     */
    public function welcome(){
        $Model = M();
        $usrID = session('user.usrID');

        $sql = "SELECT LastLoginTime,LastLoginIP FROM AdminUserLoginLog WHERE AdminID={$usrID} ORDER BY LastLoginTime DESC LIMIT 1,1 ;";
        $data = $Model->query($sql);
        $this->assign('loginTime',$data[0]['lastlogintime']);
        $this->assign('loginIpAddr',$data[0]['lastloginip']);
        $this->display();
    }

    /**
     * 加载客户列表页
     */
    public function CustomerList(){
        $model = D('customer');
        $data = $model->getCustomerList();
        $this->assign('customerList',$data);
        $this->display('customer_list');
    }

    /**
     * 加载客户信息页
     */
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
        $this->error('非法操作！',U('Index/login'));
    }
}