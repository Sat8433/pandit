<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Return different views based on user type
        if ($user->user_type === 'admin') {
            return $this->adminDashboard();
        } elseif ($user->user_type === 'pandit') {
            return view('pandit.dashboard');
        } else {
            return view('dashboard');
        }
    }

    /**
     * Display the admin dashboard.
     */
    public function adminDashboard()
    {
        $totalUsers = \App\Models\User::where('user_type', 'user')->count();
        $totalPandits = \App\Models\User::where('user_type', 'pandit')->count();
        $totalPoojas = \App\Models\Pooja::count();
        $totalBookings = \App\Models\Booking::count();
        
        return view('admin.dashboard', compact('totalUsers', 'totalPandits', 'totalPoojas', 'totalBookings'));
    }

    /**
     * Display the pandit dashboard.
     */
    public function panditDashboard()
    {
        return view('pandit.dashboard');
    }
}
