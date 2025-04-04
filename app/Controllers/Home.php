<?php

namespace App\Controllers;

class Home extends BaseController {

    public function principal(): string {
        $data = [
            'title' => 'Principal'
        ];

        return view('page/principal', $data);
    }

    public function about(): string {
        $data = [
            'title' => 'About'
        ];

        return view('page/about', $data);
    }

    public function contact(): string {
        $data = [
            'title' => 'Contact'
        ];

        return view('page/contact', $data);
    }

}
