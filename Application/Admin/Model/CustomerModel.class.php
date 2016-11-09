<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016.11.09
 * Time: 22:02
 */
namespace Admin\Model;
use Think\Model;

/**
 * 客户模型类
 * Class CustomerModel
 * @package Admin\Model
 */
class CustomerModel extends Model{

    /**
     * 获取客户列表信息
     * @return mixed
     */
    public function getCustomerList(){
        $data = $this->field('C_ID,C_Name,Gender,C_Address,Phone')->select();
        return $data;
    }

    /**
     * 获取对应客户详细信息
     * @param int $id 客户ID
     * @return bool|mixed
     */
    public function getCustomerInfo($id){
        if (!empty($id)){
            $where = 'C_ID='.$id;
            $data = $this->where($where)->field('C_ID,C_Name,Gender,C_Address,Phone')->find();
            return $data;
        } else {
            return false;
        }

    }

    /**
     * 添加客户
     * @param string $Name 客户姓名
     * @param string $Gender 客户性别
     * @param string $Address 联系地址
     * @param string $Phone 联系电话
     * @return mixed
     */
    public function addCustomer($Name,$Gender,$Address,$Phone){
        $data['C_Name']=$Name;
        $data['Gender']=$Gender;
        $data['C_Address']=$Address;
        $data['Phone']=$Phone;

        return $this->add($data);
    }

    /**
     * 更新客户信息
     * @param int $whereID 客户ID
     * @param string $Name 客户姓名
     * @param string $Gender 客户性别
     * @param string $Address 联系地址
     * @param string $Phone 联系电话
     * @return bool
     */
    public function updateCustomer($whereID,$Name,$Gender,$Address,$Phone){
        if (!empty($whereID)){
            $data['C_Name']=$Name;
            $data['Gender']=$Gender;
            $data['C_Address']=$Address;
            $data['Phone']=$Phone;

            $whereClause = 'C_ID='.$whereID;
            return $this->where($whereClause)->save($data);
        } else {
            return false;
        }
    }

    /**
     * 删除客户
     * @param int $whereID 客户ID
     * @return bool|mixed
     */
    public function deleteCustomer($whereID){
        if (!empty($whereID)){
            $whereClause = 'C_ID='.$whereID;
            return $this->where($whereClause)->delete();
        } else {
            return false;
        }
    }
}