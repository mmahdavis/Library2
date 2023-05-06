<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a Home View In Dashboard.
     */
    public function home()
    {
        return Inertia::render('HomeView');
    }

    /**
     * Display a Profile View In Dashboard.
     */
    public function profile()
    {
        return Inertia::render('ProfileView');
    }

    /**
     * Display a Notofication View In Dashboard.
     */
    public function notification()
    {
        $notifications = Notification::where('user_id', Auth()->user()->id)->get();
        return Inertia::render('NotificationView', [
            'notifications' => $notifications,
        ]);
    }
}
