<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtesaniasController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function sendArtesanias()
    {
        return response()->json([1,2,3]);
    }
}
