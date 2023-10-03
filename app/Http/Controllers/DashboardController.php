<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pIndex = 'dashboard';

        $param = [
            'pIndex' => $pIndex
        ];

        return view('dashboard', $param);
    }
}
