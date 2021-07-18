<?php
	
	namespace App\Controllers;
	use CodeIgniter\Controller;
	use App\Models\UserModel;

	class StudentList extends Controller{

		public function index(){

			$userModel = new UserModel();
			$data['students'] = $userModel->getStudentList();
			return view('student-list', $data);
		}
	}