<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-premium">
        <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Revenue Cycle</div>
        <div class="text-2xl font-black text-slate-900 tracking-tightest">Rp {{ number_format($invoices->sum('amount')) }}</div>
    </div>
    <div class="bg-admin-900 p-8 rounded-[40px] shadow-2xl shadow-admin-900/20">
        <div class="text-[10px] font-black text-white/50 uppercase tracking-widest mb-2">Accounts Receivable</div>
        <div class="text-2xl font-black text-white tracking-tightest">{{ $invoices->where('status', '!=', 'paid')->count() }} Active</div>
    </div>
    <button onclick="openAddInvoiceModal()" class="bg-emerald-500 p-8 rounded-[40px] text-white flex flex-col items-center justify-center hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-500/20">
        <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M12 4v16m8-8H4"></path></svg>
        <span class="text-[10px] font-black uppercase tracking-widest">Generate Invoice</span>
    </button>
</div>

<div class="bg-white rounded-[40px] border border-slate-100 shadow-premium overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Invoice Unit</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Financial Meta</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Settlement</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Verification</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($invoices as $inv)
                <tr class="group hover:bg-slate-50/30 transition-colors">
                    <td class="px-8 py-6">
                        <div class="font-black text-admin-900 text-xs tracking-widest mb-1">#{{ $inv->invoice_number }}</div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ $inv->client_name }}</div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-sm font-black text-slate-900">Rp {{ number_format($inv->amount) }}</div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Due: {{ $inv->due_date->format('d M') }}</div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider {{ $inv->status === 'paid' ? 'bg-emerald-50 text-emerald-600' : 'bg-orange-50 text-orange-600' }}">
                            {{ $inv->status }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-2">
                             <a href="{{ route('invoice.view', $inv->verification_token) }}" target="_blank" class="p-2 bg-slate-50 text-slate-400 rounded-xl hover:bg-brand-50 hover:text-brand-600 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                            <form action="{{ route('admin.invoices.destroy', $inv->id) }}" method="POST" onsubmit="return confirm('Void this invoice?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 bg-slate-50 text-red-300 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
