<?php

namespace TuklasPinas\Http\Controllers\Admin;
use TuklasPinas\Http\Requests;
use Illuminate\Http\Request;
use TuklasPinas\Http\Controllers\Controller;

class AdminHomeController extends Controller
{
    public function home(){
        $title='Admin';
        return view('admin/home')->with('title',$title);
    }

   
}
