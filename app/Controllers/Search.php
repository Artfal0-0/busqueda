<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Search extends Controller
{
    public function principal()
    {
        return view('layouts/index');
    }
    public function index()
    {
        return view('search/index');
    }

    public function history()
    {
        return view('search/history');
    }

    public function responses()
    {
        return view('search/responses');
    }

    public function sources()
    {
        return view('search/sources');
    }
}
