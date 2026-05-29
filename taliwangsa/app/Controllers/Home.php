<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('home/index');
    }

    public function howItWorks()
    {
        return view('home/how_it_works');
    }
}