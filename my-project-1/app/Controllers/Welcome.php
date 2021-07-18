<?php

namespace App\Controllers;
use CodeIgniter\Controller;
//use CodeIgniter\Exceptions\PageNotFoundException;

class Welcome extends Controller{
    
    public function index(){

        echo view("my-view");
    }

    public function test($x){
        echo "Welcome to the ".$x;
    }

    public function address($x, $y){
        echo "My name is ". $x ." and I am ".$y." years old";
    }

    public function home(){
        echo view("layouts/header");
        echo view("my-landing-page");
        echo view("layouts/footer");
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
