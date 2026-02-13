<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;

class AdminController extends Controller
{
    public function dashboard()
    {
        $total = Application::count();
        $pending = Application::where('status', 'pending')->count();
        $approved = Application::where('status', 'approved')->count();
        $rejected = Application::where('status', 'rejected')->count();

        $applications = Application::latest()->take(10)->get();

        return view('admin.dashboard', compact('total', 'pending', 'approved', 'rejected', 'applications'));
    }
}
