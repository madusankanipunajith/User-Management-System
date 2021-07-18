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
}
