<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('form');
    }

    public function marriage_create()
    {
        return view('marriage.create');
    }

    public function marriage_certificate()
    {
        return view('templates.marriage_certificate');
    }

    public function nikah_nama()
    {
        return view('templates.nikah_nama');
    }


}
