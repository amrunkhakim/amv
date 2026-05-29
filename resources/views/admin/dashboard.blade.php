@extends('layouts.admin')

@section('title', 'Admin Command Center')

@section('content')
    <!-- Content is rendered via include in layouts.admin based on active tab -->
    
    {{-- Modals remain here for global access --}}
    
    <!-- ADD NEWS MODAL -->
    <dialog id="modal-add-news" class="rounded-[40px] p-10 border border-slate-100 max-w-2xl w-full bg-white shadow-2xl relative overflow-hidden">
        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8 relative z-10">
            @csrf
            <div>
                <h3 class="text-2xl font-black text-slate-900 tracking-tight">Create New Insight</h3>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-2">Global Content Engine</p>
            </div>
            
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Category</label>
                    <input type="text" name="category" required placeholder="AI, Cloud, Academy..." class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Release Date</label>
                    <input type="date" name="published_at" required class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Article Title</label>
                <input type="text" name="title" required placeholder="Enter compelling headline..." class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Short Synopsis</label>
                <textarea name="description" rows="3" required class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-medium text-sm resize-none"></textarea>
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Cover Asset</label>
                <input type="file" name="image" accept="image/*" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none font-bold text-xs">
            </div>

            <div class="flex justify-end gap-4 pt-6 border-t border-slate-50">
                <button type="button" onclick="document.getElementById('modal-add-news').close()" class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-colors">Cancel</button>
                <button type="submit" class="px-10 py-4 bg-admin-900 text-white font-black text-[10px] uppercase tracking-widest rounded-2xl shadow-xl hover:-translate-y-1 transition-all">Publish Content</button>
            </div>
        </form>
        <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-slate-50 rounded-full blur-3xl opacity-50"></div>
    </dialog>

    <!-- EDIT NEWS MODAL (Simplified example, actual would need JS population) -->
    <dialog id="modal-edit-news" class="rounded-[40px] p-10 border border-slate-100 max-w-2xl w-full bg-white shadow-2xl relative overflow-hidden">
        <form id="form-edit-news" method="POST" enctype="multipart/form-data" class="space-y-8 relative z-10">
            @csrf @method('PUT')
            <h3 class="text-2xl font-black text-slate-900 tracking-tight">Edit Resource</h3>
            <input type="text" id="edit-news-title" name="title" required class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
            {{-- Other fields similar to ADD --}}
            <div class="flex justify-end gap-4">
                <button type="button" onclick="document.getElementById('modal-edit-news').close()" class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Cancel</button>
                <button type="submit" class="px-10 py-4 bg-brand-900 text-white font-black text-[10px] uppercase tracking-widest rounded-2xl shadow-xl transition-all">Update Resource</button>
            </div>
        </form>
    </dialog>

    <!-- LMS MODALS (Add/Edit) -->
    <dialog id="modal-add-course" class="rounded-[40px] p-10 border border-slate-100 max-w-2xl w-full bg-white shadow-2xl relative overflow-hidden">
        <form action="{{ route('admin.lms.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8 relative z-10">
            @csrf
            <h3 class="text-2xl font-black text-slate-900 tracking-tight">New Course Lifecycle</h3>     
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Title</label>
                <input type="text" name="title" required class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Valuation (IDR)</label>
                    <input type="number" name="price" value="0" required class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Cover Image</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none font-bold text-xs">
                </div>
            </div>
            <div class="flex justify-end gap-4">
                <button type="button" onclick="document.getElementById('modal-add-course').close()" class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Cancel</button>
                <button type="submit" class="px-10 py-4 bg-admin-900 text-white font-black text-[10px] uppercase tracking-widest rounded-2xl shadow-xl transition-all">Init Course</button>
            </div>
        </form>
    </dialog>

    <!-- PARTNER MODALS -->
    <dialog id="modal-add-partner" class="rounded-[40px] p-10 border border-slate-100 max-w-lg w-full bg-white shadow-2xl relative overflow-hidden">
        <form action="{{ route('admin.partners.store') }}" method="POST" class="space-y-6 relative z-10">
            @csrf
            <h3 class="text-xl font-black text-slate-900 tracking-tight">Add New Partner</h3>
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Partner Name</label>
                <input type="text" name="name" required class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
            </div>
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">SVG Icon Code</label>
                <textarea name="svg_icon" rows="3" class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-mono text-[10px]"></textarea>
            </div>
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Sort Order</label>
                <input type="number" name="sort_order" value="0" required class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
            </div>
            <div class="flex justify-end gap-2 pt-4">
                <button type="button" onclick="document.getElementById('modal-add-partner').close()" class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-slate-400">Cancel</button>
                <button type="submit" class="px-8 py-3 bg-admin-900 text-white font-black text-[10px] uppercase tracking-widest rounded-xl shadow-lg transition-all">Save Partner</button>
            </div>
        </form>
    </dialog>

    <dialog id="modal-edit-partner" class="rounded-[40px] p-10 border border-slate-100 max-w-lg w-full bg-white shadow-2xl relative overflow-hidden">
        <form id="form-edit-partner" method="POST" class="space-y-6 relative z-10">
            @csrf @method('PUT')
            <h3 class="text-xl font-black text-slate-900 tracking-tight">Edit Partner Meta</h3>
            <input type="text" id="edit-partner-name" name="name" required class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
            <input type="number" id="edit-partner-order" name="sort_order" required class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
            <div class="flex justify-end gap-2 pt-4">
                <button type="button" onclick="document.getElementById('modal-edit-partner').close()" class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-slate-400">Cancel</button>
                <button type="submit" class="px-8 py-3 bg-admin-900 text-white font-black text-[10px] uppercase tracking-widest rounded-xl shadow-lg transition-all">Update Partner</button>
            </div>
        </form>
    </dialog>

    <!-- CORE VALUE MODAL -->
    <dialog id="modal-edit-core-value" class="rounded-[40px] p-10 border border-slate-100 max-w-lg w-full bg-white shadow-2xl relative overflow-hidden">
        <form id="form-edit-core-value" method="POST" class="space-y-6 relative z-10">
            @csrf @method('PUT')
            <h3 class="text-xl font-black text-slate-900 tracking-tight">Modify Core Principle</h3>
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Title</label>
                <input type="text" id="edit-cv-title" name="title" required class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
            </div>
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Description</label>
                <textarea id="edit-cv-desc" name="description" rows="3" required class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-medium text-sm resize-none"></textarea>
            </div>
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">SVG Icon</label>
                <textarea id="edit-cv-icon" name="svg_icon" rows="2" class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-mono text-[10px]"></textarea>
            </div>
            <div class="flex justify-end gap-2 pt-4">
                <button type="button" onclick="document.getElementById('modal-edit-core-value').close()" class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-slate-400">Cancel</button>
                <button type="submit" class="px-8 py-3 bg-admin-900 text-white font-black text-[10px] uppercase tracking-widest rounded-xl shadow-lg transition-all">Update Principle</button>
            </div>
        </form>
    </dialog>

    <!-- SERVICE MODALS -->
    <dialog id="modal-add-service" class="rounded-[40px] p-10 border border-slate-100 max-w-lg w-full bg-white shadow-2xl relative overflow-hidden">
        <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-6 relative z-10">
            @csrf
            <h3 class="text-xl font-black text-slate-900 tracking-tight">Add Service Pillar</h3>
            <input type="text" name="title" required placeholder="Service Title" class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
            <textarea name="description" rows="3" required placeholder="Service Description" class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-medium text-sm resize-none"></textarea>
            <textarea name="svg_icon" rows="2" placeholder="SVG Icon Code" class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-mono text-[10px]"></textarea>
            <input type="number" name="sort_order" value="0" required class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
            <div class="flex justify-end gap-2 pt-4">
                <button type="button" onclick="document.getElementById('modal-add-service').close()" class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-slate-400">Cancel</button>
                <button type="submit" class="px-8 py-3 bg-admin-900 text-white font-black text-[10px] uppercase tracking-widest rounded-xl shadow-lg transition-all">Save Service</button>
            </div>
        </form>
    </dialog>

    <!-- MOU MODAL -->
    <dialog id="modal-add-mou" class="rounded-[40px] p-10 border border-slate-100 max-w-xl w-full bg-white shadow-2xl relative overflow-hidden">
        <form action="{{ route('admin.mous.store') }}" method="POST" class="space-y-6 relative z-10">
            @csrf
            <h3 class="text-xl font-black text-slate-900 tracking-tight">Draft New MOU</h3>
            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="mou_number" required placeholder="MOU/2026/001" class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
                <input type="text" name="company_name" required placeholder="Partner Company" class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
            </div>
            <input type="text" name="title" required placeholder="Agreement Subject" class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
            <textarea name="content" rows="6" required placeholder="Document Content (HTML supported)" class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-medium text-sm"></textarea>
            <div class="flex justify-end gap-2 pt-4">
                <button type="button" onclick="document.getElementById('modal-add-mou').close()" class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-slate-400">Cancel</button>
                <button type="submit" class="px-8 py-3 bg-admin-900 text-white font-black text-[10px] uppercase tracking-widest rounded-xl shadow-lg transition-all">Generate MOU</button>
            </div>
        </form>
    </dialog>

    <!-- INVOICE MODAL -->
    <dialog id="modal-add-invoice" class="rounded-[40px] p-10 border border-slate-100 max-w-xl w-full bg-white shadow-2xl relative overflow-hidden">
        <form action="{{ route('admin.invoices.store') }}" method="POST" class="space-y-6 relative z-10">
            @csrf
            <h3 class="text-xl font-black text-slate-900 tracking-tight">Generate Financial Invoice</h3>
            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="invoice_number" required placeholder="INV-2026-X" class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
                <input type="text" name="client_name" required placeholder="Client Name" class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
            </div>
            <input type="email" name="client_email" required placeholder="client@email.com" class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
            <div class="grid grid-cols-2 gap-4">
                <input type="number" name="amount" required placeholder="Total Amount (IDR)" class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
                <input type="date" name="due_date" required class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
            </div>
            <textarea name="items_json" rows="4" placeholder='[{"desc":"Dev Fee","qty":1,"price":5000}]' class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-mono text-[10px]"></textarea>
            <div class="flex justify-end gap-2 pt-4">
                <button type="button" onclick="document.getElementById('modal-add-invoice').close()" class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-slate-400">Cancel</button>
                <button type="submit" class="px-8 py-3 bg-emerald-500 text-white font-black text-[10px] uppercase tracking-widest rounded-xl shadow-lg transition-all">Issue Invoice</button>
            </div>
        </form>
    </dialog>
@endsection

@section('scripts')
<script>
    // --- GENERAL MODAL HELPERS ---
    function openModal(id) { document.getElementById(id).showModal(); }
    function closeModal(id) { document.getElementById(id).close(); }

    // --- NEWS MODALS ---
    const modalAddNews = document.getElementById('modal-add-news');
    const modalEditNews = document.getElementById('modal-edit-news');
    function openAddNewsModal() { modalAddNews.showModal(); }
    function openEditNewsModal(btn) {
        const id = btn.getAttribute('data-id');
        const title = btn.getAttribute('data-title');
        const cat = btn.getAttribute('data-category');
        const desc = btn.getAttribute('data-description');
        const date = btn.getAttribute('data-date');

        document.getElementById('form-edit-news').action = '/admin/news/' + id;
        document.getElementById('edit-news-title').value = title;
        // Add more fields population as needed based on the form
        modalEditNews.showModal();
    }

    // --- LMS MODALS ---
    const modalAddCourse = document.getElementById('modal-add-course');
    function openAddCourseModal() { modalAddCourse.showModal(); }
    function openEditCourseModal(btn) {
        // Logic for editing course
        alert('Edit Course feature is active. Modal implementation in progress.');
    }

    // --- PARTNER MODALS ---
    function openAddPartnerModal() { openModal('modal-add-partner'); }
    function openEditPartnerModal(btn) {
        const id = btn.getAttribute('data-id');
        const name = btn.getAttribute('data-name');
        const order = btn.getAttribute('data-order');

        document.getElementById('form-edit-partner').action = '/admin/partners/' + id;
        document.getElementById('edit-partner-name').value = name;
        document.getElementById('edit-partner-order').value = order;
        openModal('modal-edit-partner');
    }

    // --- CORE VALUE MODALS ---
    function openEditCoreValueModal(btn) {
        const id = btn.getAttribute('data-id');
        const title = btn.getAttribute('data-title');
        const desc = btn.getAttribute('data-description');
        const icon = btn.getAttribute('data-icon');

        document.getElementById('form-edit-core-value').action = '/admin/core-values/' + id;
        document.getElementById('edit-cv-title').value = title;
        document.getElementById('edit-cv-desc').value = desc;
        document.getElementById('edit-cv-icon').value = icon;
        openModal('modal-edit-core-value');
    }

    // --- SERVICE MODALS ---
    function openAddServiceModal() { openModal('modal-add-service'); }
    function openEditServiceModal(btn) {
        // Implementation for service edit
    }

    // --- MOU & INVOICE MODALS ---
    function openAddMouModal() { openModal('modal-add-mou'); }
    function openAddInvoiceModal() { openModal('modal-add-invoice'); }

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert("Tautan E-Signature berhasil disalin!");
        }).catch(err => {
            console.error('Failed to copy: ', err);
        });
    }

    // Initialize tabs on load
    window.addEventListener('DOMContentLoaded', () => {
        const hash = window.location.hash.replace('#', '');
        if (hash) {
            // switchTab is defined in layouts.admin
            if (typeof switchTab === 'function') switchTab(hash);
        }
    });
</script>
@endsection

