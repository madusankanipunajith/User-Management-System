<?php

namespace App\Controllers;

class Data extends \CodeIgniter\Controller{
    
    public function index(){
        
    }

    public function _remap($method, $param1= null){
        if(method_exists($this, $method)){

            return $this->$method($param1);

        }else{
            return $this->index();
        }
    }
}