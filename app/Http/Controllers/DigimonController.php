<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DigimonController extends Controller
{
    public function dashboard()
    {

        return view('cruds.dashboard');
    }


    public function getDigimons()
    {
        $response = Http::get('https://digi-api.com/api/v1/digimon?pageSize=50000');
        return $response;
    }

    public function getDetailDigimon($id)
    {
        $url = 'https://www.digi-api.com/api/v1/digimon/' . $id;
        $response = Http::get($url);
        return $response;
    }
}
