<?php

namespace App\Controllers;
use \CodeIgniter\Controller;
	

class FileUpload extends Controller{
	public $session;
	public $email;

	public function __construct(){
		helper('form');
		helper('date');
		$this->session = \CodeIgniter\Config\Services::session();
		$this->email = \Config\Services::email();
	}


	public function index(){

		$data = [];
		$data['validation'] = null;

		$rules= [
			'avatar' => 'uploaded[avatar]|max_size[avatar,1024]|ext_in[avatar,png,jpg,gif]',
		];

		if ($this->request->getMethod() == 'post') {

			if ($this->validate($rules)) {


			$file = $this->request->getFile('avatar');

				if ($file->isValid() && !$file->hasMoved()) {
					$newname = $file->getRandomName();
					if ($file->move(WRITEPATH.'/uploads/', $newname)) {
						echo '<p>File Upload Successfully....</p>';

					}else{
						echo $file->getErrorString()." ".$file->getError();
					}
				}
			}else{
				$data['validation'] = $this->validator;
			}
		}

		return view('file-view', $data);
	}



}