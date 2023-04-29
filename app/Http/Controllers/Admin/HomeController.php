<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showAdminDashboard()
    {
        return view('admin.dashboard.index');
    }
}
