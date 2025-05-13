<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function index(){
        return view('category.category');
    }

    public function create(){
        return view('category.create');
    }
}
