<?php

namespace CUBiM\Http\Controllers;

use Illuminate\Http\Request;

use CUBiM\Http\Requests;
use CUBiM\Http\Controllers\Controller;

class MainController extends Controller
{

    public function home()
    {
        return view('welcome')->with('active', array('sup' => 'dashboard'));
    }
}
