<?php

namespace App\Controllers;

class Blog extends \CodeIgniter\Controller
{
        public function index()
        {
                $data['title']   = "My Real Title";
                $data['heading'] = "My Real Heading";
                $data['subjects'] = ['A', 'B', 'C', 'D'];

                echo view('my-view', $data);
        }

        public function _remap($method, $param1 = null, $param2 = null){
            if(method_exists($this, $method)){
                return $this-> $method($param1, $param2);
            }else{
                return $this->index();
            }
    
            // throw PageNotFoundException::forPageNotFound();
        } 
}