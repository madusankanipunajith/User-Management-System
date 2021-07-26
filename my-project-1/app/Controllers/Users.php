<?php

namespace App\Controllers;
use \CodeIgniter\Controller;
use App\Models\ContactModel;
use App\Models\UserModel;
use App\Models\RegisterModel;

class Users extends Controller{
	public $contactModel;
	public $registerModel;
	public $session;
	public $email;

	public function __construct(){
		helper('form');
		helper('date');
		$this->contactModel = new ContactModel();
		$this->registerModel = new RegisterModel();
		$this->email = \Config\Services::email();
		$this->session = \CodeIgniter\Config\Services::session();
	}
	
	

	public function home(){
		echo view('home');
	}

	public function register(){
		$data =[];
		$data['validation'] = null;

		$rules= [
			'name' => 'required|min_length[3]|max_length[20]',
			'email' => 'required|valid_email|is_unique[customers.email]',
			'mobile' => 'required|exact_length[10]|numeric',
			'password' => 'required',
			'confirm' => 'required|matches[password]'
		];

		if ($this->request->getMethod() == 'post') {

			if ($this->validate($rules)) {

				$uni_id = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz'.time())); 
			
				$custData=[
					'uni_id' => $uni_id,
					'name' => $this->request->getVar('name', FILTER_SANITIZE_STRING),
					'email' => $this->request->getVar('email', FILTER_SANITIZE_STRING),
					'mobile' => $this->request->getVar('mobile'),
					'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
					'activation_date' => date('Y-m-d h:i:s'),
				];
				$status=$this->registerModel->createUser($custData);
				if ($status) {
					$to = $this->request->getVar('email');
					$subject = 'Account activation link- (SunimalFoods)';
					$message = 'Hi'.$this->request->getVar('name', FILTER_SANITIZE_STRING).",<br><br> Thank you for creating an account. Please click the below link to activate your account<br><br>".
						"<a href='".base_url()."/users/activate/".$uni_id."' target='_blank'>Activate Now</a><br><br>Sunimal";

						$this->email->setTo($to);
						$this->email->setFrom('curvesstitches@gmail.com', 'madusanka');
						$this->email->setSubject($subject);
						$this->email->setMessage($message);

						if ($this->email->send()) {
							$this->session->setTempdata('success','Account created successfully',3);
                    		return redirect()->to(current_url());
						}else{
							//$data = $email->printDebugger(['headers']);
							//print_r($data);
							$this->session->setTempdata('error','Sorry! Unable to create activation link',3);
                    		return redirect()->to(current_url());
						}


				}else{

					$this->session->setTempdata('error','Sorry! Try Agaian',3);
                    return redirect()->to(current_url());
				}

			
			}else{
				$data['validation'] = $this->validator;

			}
		}

		echo view('register-form', $data);
	}

	public function activate($uni_id=null){


		$data=[];

		if(!empty($uni_id)){
			$user_data = $this->registerModel->verify_uni_id($uni_id);
			if ($user_data) {
			
			function verifyExpTime($reg_time){
				$curTime = now();
				$regTime = strtotime($reg_time);
				$diffTime = (int)$curTime-(int)$regTime;

				if(3600 < $diffTime){
					return true;
				}else{
					return false;
				}
			}

				if (verifyExpTime($user_data->activation_date)) {

					if($user_data->status == 'inactive'){
						$status= $this->registerModel->updateStatus($uni_id);
						if ($status) {
							$data['success'] = "Account activated successfully...";
						}else{
							$data['error'] = "...";
						}
					}else{
						$data['success'] = "Activation link was already active...";
					}
					
				}else{
					$data['error'] = "Activation link was expired...";
				}
				
			}else{
				$data['error'] = "Sorry... We are unable to find your account...";
			}
		}else{
			$data['error'] = "Unable to proccess your request...";
		}

		echo view('activate_view', $data);
	}

	

	public function login()
	{
		echo view('login-form');
	}































	public function index(){
		$data =[];
		$data['validation'] = null;

		$session = \CodeIgniter\Config\Services::session();

		$rules= [
			'username' => 'required|min_length[3]|max_length[20]',
			'email' => 'required|valid_email',
			'mobile' => 'required|exact_length[10]|numeric',
			'msg' => 'required',
		];

		if($this->request->getMethod() == 'post'){

			if ($this->validate($rules)) {

				$uni_id = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz'.time())); 

				$cdata=[
					'username' => $this->request->getVar('username', FILTER_SANITIZE_STRING),
					'email' => $this->request->getVar('email', FILTER_SANITIZE_STRING),
					'mobile' => $this->request->getVar('mobile', FILTER_SANITIZE_STRING),
					'message' => $this->request->getVar('msg', FILTER_SANITIZE_STRING),
				];

				$status = $this->contactModel->saveData($cdata);

				if ($status) {
					$to = $this->request->getVar('email');
					$subject = 'Account activation link- (SunimalFoods)';
					$message = 'Hi'.$this->request->getVar('name', FILTER_SANITIZE_STRING).",<br><br> Thank you for creating an account. Please click the below link to activate your account<br><br>".
						"<a href='".base_url()."/users/activate/".$uni_id."' target='_blank'>Activate Now</a><br><br>Sunimal";

						$this->email->setTo($to);
						$this->email->setFrom('curvesstitches@gmail.com', 'madusanka');
						$this->email->setSubject($subject);
						$this->email->setMessage($message);

						if ($this->email->send()) {
							$this->session->setTempdata('success','Account created successfully',3);
                    		return redirect()->to(current_url());
						}else{
							//$data = $email->printDebugger(['headers']);
							//print_r($data);
							$this->session->setTempdata('error','Sorry! Unable to create activation link',3);
                    		return redirect()->to(current_url());
						}


				}else{

					$this->session->setTempdata('error','Sorry! Try Agaian',3);
                    return redirect()->to(current_url());
				}
				
                var_dump($status);
                
                if($status)
                {	
                    $session->setTempdata('success','Thanks, We will get back you soon',3);
                    return redirect()->to(current_url());
                }
                else
                {
                    $session->setTempdata('error','Sorry! Try Agaian',3);
                    return redirect()->to(current_url());
                }

			}else{
				$data['validation'] = $this->validator;
			}
		}

		echo view('my-form', $data);

	}
}