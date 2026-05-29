<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = auth()->user()->tickets()->orderBy('updated_at', 'desc')->get();
        return view('portal.tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('portal.tickets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'priority' => 'required|in:low,normal,high,urgent',
            'message' => 'required|string',
        ]);

        auth()->user()->tickets()->create($validated);

        return redirect()->route('portal.tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function show(\App\Models\Ticket $ticket)
    {
        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }
        $ticket->load('replies.user');
        return view('portal.tickets.show', compact('ticket'));
    }

    public function reply(Request $request, \App\Models\Ticket $ticket)
    {
        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $ticket->replies()->create([
            'user_id' => auth()->id(),
            'message' => $validated['message'],
        ]);

        $ticket->touch(); // Update updated_at timestamp

        return back()->with('success', 'Reply added.');
    }
}
