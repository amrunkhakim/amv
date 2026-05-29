<div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Prospect</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Project Inquiry</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Received At</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($contacts as $contact)
                <tr class="group hover:bg-slate-50/30 transition-colors">
                    <td class="px-8 py-6">
                        <div class="font-black text-slate-900 text-sm tracking-tight">{{ $contact->name }}</div>
                        <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">{{ $contact->email }}</div>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-xs font-medium text-slate-600 leading-relaxed line-clamp-2 max-w-md">{{ $contact->message }}</p>
                    </td>
                    <td class="px-8 py-6 text-xs font-black text-slate-400">{{ $contact->created_at->format('d M, H:i') }}</td>
                    <td class="px-8 py-6 text-right">
                         <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Archive this inquiry?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 text-slate-300 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
