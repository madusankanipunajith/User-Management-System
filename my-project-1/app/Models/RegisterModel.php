<?php

namespace App\Models;
use CodeIgniter\Model;

class RegisterModel extends Model{
	public function createUser($data){

		// Model class also have defined the db object. Hence we don't need to connect the database manually
		$db = \Config\Database::connect();
        $builder = $db->table('customers');
        $res = $builder->insert($data);

		if ($this->db->affectedRows() >= 1) {
			return true;
		}else{
			return false;
		}	
	}

	public function verify_uni_id($id){
		// Model class also have defined the db object. Hence we don't need to connect the database manually
		$db = \Config\Database::connect();
        $builder = $db->table('customers');

        $builder->select('activation_date,uni_id,status');
        $builder->where('uni_id', $id);
        $result = $builder->get();
        $row = $result->getRow();
        if(count($result->getResultArray())== 1){
        	return $row;
        }else{
        	return false;
       	}
       
	}

	public function updateStatus($id){
		// Model class also have defined the db object. Hence we don't need to connect the database manually
		$db = \Config\Database::connect();
        $builder = $db->table('customers');
        $builder->where('uni_id', $id);
        $builder->update(['status' => 'active']);

        if ($this->db->affectedRows() == 1) {
			return true;
		}else{
			return false;
		}	

	}
}
