<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pbController extends Controller
{
    //
    public function about(){
        return view('about');
    }
    public function index(){
        return view('index');
    }
    public function contact(){
        return view('contact');
    }
    public function post(){
        return view('post');
    }
}
