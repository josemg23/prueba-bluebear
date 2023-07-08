<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DigimonController extends Controller
{
    public function dashboard()
    {

        return view('cruds.dashboard');
    }
}
