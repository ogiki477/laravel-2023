<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    public function MyControllerFunction(){

        return view('index');
    }


    public function show_post($id,$password,$name){

        return view('home',compact('id', 'password', 'name'));
    }


    public function index(){

        return view('index');
    }
}

