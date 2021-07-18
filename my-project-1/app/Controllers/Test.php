<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class Test extends Controller{

    public function index(){
        $parser = \Config\Services::parser();

        $data =[
            'page_title' => "My Page Title",
            'page_header' => "My Page Header",
            'blog_entries' => [
                ['title' => 'Title 1', 'body' => 'Body 1'],
                ['title' => 'Title 2', 'body' => 'Body 2'],
                ['title' => 'Title 3', 'body' => 'Body 3'],
                ['title' => 'Title 4', 'body' => 'Body 4'],
                ['title' => 'Title 5', 'body' => 'Body 5']
            ],
            'date' => "2021-07-03",
            'price' => "500",
            'salary' => "780.67",
            'mobile' => "0712081918"
        ];

       // echo view("my-landing-page"); 

        return $parser->setData($data)->render("my-landing-page");
    
    }

}