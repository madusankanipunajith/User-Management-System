<?php

namespace App\Models;
use CodeIgniter\Model;

class LoginModel extends Model{

	public function verifyEmail($email){
		// Model class also have defined the db object. Hence we don't need to connect the database manually
		$db = \Config\Database::connect();
        $builder = $db->table('customers');

        $builder->select('activation_date,uni_id,status,password,name');
        $builder->where('email', $email);
        $result = $builder->get();
        $row = $result->getRowArray();
        if(count($result->getResultArray())== 1){
        	return $row;
        
        }else{
        	
        	return false;
       	}
	}

}