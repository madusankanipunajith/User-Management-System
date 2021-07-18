<?php
	namespace App\Models;
	use CodeIgniter\Model;

	class UserModel extends Model{

		public function getStudentList(){

			$db = \Config\Database::connect();

			$query = $db->query("SELECT id, name, age, school FROM students");
			$result = $query->getResult();

			if (count($result) > 0) {
				return $result;
			}else{
				return false;
			}
		}
	}