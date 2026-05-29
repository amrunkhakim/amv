<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $projectCount = $user->projects()->count();
        $activeProjects = $user->projects()->where('status', 'ongoing')->get();
        $recentInvoices = $user->invoices()->orderBy('issued_date', 'desc')->take(5)->get();
        $openTickets = $user->tickets()->where('status', '!=', 'closed')->get();

        return view('portal.dashboard', compact('user', 'projectCount', 'activeProjects', 'recentInvoices', 'openTickets'));
    }
}
