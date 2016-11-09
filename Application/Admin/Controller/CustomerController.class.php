<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/11/5
 * Time: 22:27
 */
namespace Admin\Controller;
use Think\Controller;

class CustomerController extends Controller{
    public function add(){
        if (IS_POST){
            $customer = new \Admin\Model\CustomerModel();
            $rs = $customer->AddCustomer(I('post.clName'),I('post.clGender'),I('post.clAddr'),I('post.clPhone'));
            if ($rs){
                echo 'true';
            } else {
                echo 'false';
            }
        }
    }

    public function update(){
        if (IS_POST){
            $customer = new \Admin\Model\CustomerModel();

            $id = I('post.customerID');
            $rs = $customer->UpdateCustomer($id,I('post.customerName'),I('post.customerGender'),I('post.customerAddr'),I('post.customerPhone'));
            if ($rs){
                $this->success('客户信息更新成功！',U('Admin/Iframe/CustomerList'));
            } else {
                $this->error('信息更新失败');
            }
        }
    }

    public function delete(){
        if (IS_POST){
            $customer = new \Admin\Model\CustomerModel();

            $id = I('post.C_ID/d');
            $rs = $customer->DeleteCustomer($id);
            if ($rs){
                echo 'true';
            } else {
                echo 'false';
            }
        }
    }
}