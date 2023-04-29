<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showManagerDashboard()
    {
        return view('manager.dashboard.index');
    }
}
