<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function about(): string
    {
        $data = [
            'title' => 'About Us',
            'description' => 'Learn more about our company.',
            'team' => ['Alice', 'Bob', 'Charlie'] // Array para iterar
        ];
        return view('about', $data);
    }
    public function contact(): string
    {
        $data = ['title' => 'Contact Us', 'email' => 'contact@example.com'];
        return view('contact', $data);
    }
}
