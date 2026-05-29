<div class="bg-white rounded-[40px] border border-slate-100 shadow-premium p-10 flex flex-col md:flex-row justify-between items-center gap-8 relative overflow-hidden">
    <div class="relative z-10">
        <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Legal Agreements (MOU)</h3>
        <p class="text-slate-500 text-sm mt-2 font-medium">Generate digital contracts with secure E-Signature tokens.</p>
    </div>
    <button onclick="openAddMouModal()" class="relative z-10 px-8 py-4 bg-admin-900 text-white font-black text-xs uppercase tracking-widest rounded-2xl shadow-xl hover:-translate-y-1 transition-all">Draft New MOU</button>
</div>

<div class="bg-white rounded-[40px] border border-slate-100 shadow-premium overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">MOU Identity</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Agreement Title</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Legal Status</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Verification</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($mous as $mou)
                <tr class="group hover:bg-slate-50/30 transition-colors">
                    <td class="px-8 py-6">
                        <div class="font-black text-admin-900 text-xs tracking-widest mb-1">{{ $mou->mou_number }}</div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ $mou->company_name }}</div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-sm font-extrabold text-slate-700">{{ $mou->title }}</div>
                    </td>
                    <td class="px-8 py-6">
                        @if($mou->is_signed)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 text-[9px] font-black uppercase tracking-wider rounded-full border border-emerald-100">Executed</span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-orange-50 text-orange-700 text-[9px] font-black uppercase tracking-wider rounded-full border border-orange-100 animate-pulse">Pending TTD</span>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-2">
                            <button onclick="copyToClipboard('{{ route('mou.sign', $mou->verification_token) }}')" class="p-2 bg-slate-50 text-slate-400 rounded-xl hover:bg-brand-50 hover:text-brand-600 transition-all" title="Copy Token Link">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            </button>
                            <form action="{{ route('admin.mous.destroy', $mou->id) }}" method="POST" onsubmit="return confirm('Void this legal document?')">
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
