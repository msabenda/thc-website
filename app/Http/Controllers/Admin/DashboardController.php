<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Application::count();
        $pending = Application::where('status','pending')->count();
        $approved = Application::where('status','approved')->count();
        $rejected = Application::where('status','rejected')->count();

        return view('admin.dashboard', compact('total','pending','approved','rejected'));
    }
}
