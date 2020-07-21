<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sepetController extends Controller
{
    public function index(){
        return view('sepet');
    }
}
