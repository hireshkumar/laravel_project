<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class usercontroller extends Controller
{
 
    public function index(Request $request){

        $name = "Rigster form";
        return view("user",compact('name'));

    }

}
