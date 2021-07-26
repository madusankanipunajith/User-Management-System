<?php

namespace App\Controllers;
use \CodeIgniter\Controller;
use \App\Models\LoginModel;
	
	

class Login extends Controller{
	public $loginModel;
	public $session;
	public $email;

	public function __construct(){
		helper('form');
		helper('date');
		$this->session = \CodeIgniter\Config\Services::session();
		$this->email = \Config\Services::email();
		$this->loginModel = new LoginModel();
	}


	public function index(){

		$data = [];
		$data['validation'] = null;
		
		$rules= [
			'email' => 'required|valid_email',
			'password' => 'required',
		];

		if ($this->request->getMethod() == 'post') {

			if ($this->validate($rules)) {
				
				$email = $this->request->getVar('email');
				$password = $this->request->getVar('password');

				$user_data = $this->loginModel->verifyEmail($email);
				if ($user_data) {
					print_r($user_data);
					if (password_verify($password, $user_data['password'])) {
						if ($user_data['status'] == 'active') {
							$this->session->set('logged_in', $user_data['uni_id']);
							return redirect()->to(base_url().'/dashboard');
						}else{
							$this->session->setTempdata('error','Sorry!...Plz activate your account..',3);
                    		return redirect()->to(current_url());
						}
					}else{
						$this->session->setTempdata('error','Sorry!...Password is wrong..',3);
                    	return redirect()->to(current_url());
					}
				}else{
					
					$this->session->setTempdata('error','Sorry!...Email does not exist',3);
                    return redirect()->to(current_url());
				}

			}else{
				$data['validation'] = $this->validator;
			}
		}

		return view('login-form', $data);
	}
	
}