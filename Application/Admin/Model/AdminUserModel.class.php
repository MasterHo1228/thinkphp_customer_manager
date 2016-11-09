<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016.11.09
 * Time: 22:42
 */

namespace Admin\Model;
use Think\Model;

class AdminUserModel extends Model{
    protected $tableName = 'AdminUser';//若数据库名单词没有用下划线隔开 需要在这里复写tableName变量（ThinkPHP的坑= =）

    public function CheckAccount($UserName,$Password){
        $where['Name']=$UserName;

        $tmp_Password=$this->where($where)->getField('Password');
        $tmp_salt=$this->where($where)->getField('salt');

        if(md5($Password.$tmp_salt)==$tmp_Password){
            $UserID=$this->where($where)->getField('ID');

            $loginLog = M("adminuserloginlog");
            $data['AdminID']=$UserID;
            $data['LastLoginTime']=date('Y-m-d H:i:s');
            $data['LastLoginIP']=I('server.REMOTE_ADDR');
            $loginLog->add($data);

            session('user.usrID',$UserID);
            session('user.usrName',$UserName);
            session('user.usrType',$this->where($where)->getField('UserType'));

            return true;
        } else {
            return false;
        }
    }
}