<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    /**
     * Store a newly created dynamic invoice.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'issued_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:issued_date',
            'items' => 'required|array|min:1',
            'items.*.desc' => 'required|string|max:255',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        // Calculate total amount based on items qty * price
        $amount = 0;
        $items = [];
        foreach ($request->items as $item) {
            $subtotal = $item['qty'] * $item['price'];
            $amount += $subtotal;
            $items[] = [
                'desc' => $item['desc'],
                'qty' => (int) $item['qty'],
                'price' => (float) $item['price'],
                'subtotal' => $subtotal,
            ];
        }

        // Generate Invoice Number: AMV/INV/YEAR/COUNT
        $year = date('Y');
        $count = Invoice::whereYear('created_at', $year)->count() + 1;
        $invoiceNumber = sprintf('AMV/INV/%d/%04d', $year, $count);

        Invoice::create([
            'invoice_number' => $invoiceNumber,
            'client_name' => $request->client_name,
            'client_email' => $request->client_email,
            'amount' => $amount,
            'issued_date' => $request->issued_date,
            'due_date' => $request->due_date,
            'status' => 'pending',
            'items' => $items,
            'verification_token' => Str::random(40),
        ]);

        return redirect()->to(route('admin.dashboard').'#invoices')->with('success', 'Invoice baru berhasil dibuat.');
    }

    /**
     * Update invoice payment status.
     */
    public function updateStatus(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $request->validate([
            'status' => 'required|string|in:pending,paid,cancelled',
        ]);

        $invoice->update(['status' => $request->status]);

        return redirect()->to(route('admin.dashboard').'#invoices')->with('success', 'Status pembayaran invoice diperbarui.');
    }

    /**
     * Delete an invoice.
     */
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->to(route('admin.dashboard').'#invoices')->with('success', 'Invoice berhasil dihapus.');
    }

    /**
     * Show high-fidelity printable Invoice page.
     */
    public function show($token)
    {
        $invoice = Invoice::where('verification_token', $token)->firstOrFail();
        $settings = DB::table('settings')->pluck('value', 'key')->toArray();

        return view('invoice.view', compact('invoice', 'settings'));
    }

    /**
     * Public page to verify invoice authenticity via scanning QR code.
     */
    public function verify($token)
    {
        $invoice = Invoice::where('verification_token', $token)->first();
        $settings = DB::table('settings')->pluck('value', 'key')->toArray();

        return view('invoice.verify', compact('invoice', 'settings'));
    }
}
