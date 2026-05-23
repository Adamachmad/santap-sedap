<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrankController extends Controller
{
    public function index()
    {
        return view('prank');
    }
}
