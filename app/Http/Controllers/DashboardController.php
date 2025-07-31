<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Trainer;
use App\Models\Session;
use App\Models\Payment;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the main dashboard.
     */
    public function index()
    {
        $today = Carbon::today();
        
        // Get dashboard statistics
        $stats = [
            'total_clients' => Client::count(),
            'active_clients' => Client::where('status', 'active')->count(),
            'total_trainers' => Trainer::count(),
            'active_trainers' => Trainer::where('status', 'active')->count(),
            'todays_sessions' => Session::whereDate('scheduled_at', $today)->count(),
            'upcoming_sessions' => Session::where('scheduled_at', '>', now())
                ->where('status', 'scheduled')
                ->count(),
            'total_revenue' => Payment::where('status', 'completed')->sum('amount'),
            'outstanding_balance' => Client::sum('outstanding_balance'),
        ];

        // Get recent activities
        $recent_sessions = Session::with(['client', 'trainer'])
            ->whereDate('scheduled_at', '>=', $today)
            ->orderBy('scheduled_at')
            ->limit(5)
            ->get();

        $recent_payments = Payment::with('client')
            ->where('status', 'completed')
            ->orderBy('processed_at', 'desc')
            ->limit(5)
            ->get();

        $recent_clients = Client::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'recent_sessions' => $recent_sessions,
            'recent_payments' => $recent_payments,
            'recent_clients' => $recent_clients,
        ]);
    }
}