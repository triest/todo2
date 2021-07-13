<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $tags=Tag::select()->get();

        return view('home')->with(['tags'=>$tags]);
    }
}
