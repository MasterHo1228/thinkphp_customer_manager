<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/11/5
 * Time: 22:27
 */
namespace Admin\Controller;
use Think\Controller;

class ClientController extends Controller{
    public function add(){
        if (IS_POST){
            $customer=M('customer');
            $data['C_Name']=I('post.clName');
            $data['Gender']=I('post.clGender');
            $data['C_Address']=I('post.clAddr');
            $data['Phone']=I('post.clPhone');

            $rs = $customer->add($data);
            if ($rs){
                echo 'true';
            } else {
                echo 'false';
            }
        }
    }

    public function update(){
        if (IS_POST){
            $customer=M('customer');
            $data['C_Name']=I('post.clientName');
            $data['Gender']=I('post.clientGender');
            $data['C_Address']=I('post.clientAddr');
            $data['Phone']=I('post.clientPhone');

            $id = I('post.clientID');
            $where = 'C_ID='.$id;
            $rs = $customer->where($where)->save($data);
            if ($rs){
                $this->success('客户信息更新成功！',U('Admin/Iframe/ClientList'));
            } else {
                $this->error('信息更新失败');
            }
        }
    }

    public function delete(){
        if (IS_POST){
            $customer=M('customer');
            $id = I('post.C_ID/d');
            $where = 'C_ID='.$id;
            $rs = $customer->where($where)->delete();
            if ($rs){
                echo 'true';
            } else {
                echo 'false';
            }
        }
    }
}