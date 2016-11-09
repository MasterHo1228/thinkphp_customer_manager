<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016.11.09
 * Time: 22:02
 */
namespace Admin\Model;
use Think\Model;

class CustomerModel extends Model{
    public function AddCustomer($Name,$Gender,$Address,$Phone){
        $data['C_Name']=$Name;
        $data['Gender']=$Gender;
        $data['C_Address']=$Address;
        $data['Phone']=$Phone;

        return $this->add($data);
    }

    public function UpdateCustomer($whereID,$Name,$Gender,$Address,$Phone){
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

    public function DeleteCustomer($whereID){
        if (!empty($whereID)){
            $whereClause = 'C_ID='.$whereID;
            return $this->where($whereClause)->delete();
        } else {
            return false;
        }
    }
}