<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainPageController extends Controller
{
    public function test()
    {
        $id = Auth::id();
        print_r($id);
    }
}
