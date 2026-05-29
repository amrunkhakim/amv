<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MouController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

// Public Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Public Subpages
Route::get('/tentang', [HomeController::class, 'about'])->name('about');
Route::get('/layanan', [HomeController::class, 'services'])->name('services');
Route::get('/portofolio', [HomeController::class, 'portfolio'])->name('portfolio');
Route::get('/insight', [HomeController::class, 'news'])->name('news');
Route::get('/insight/{slug}', [NewsController::class, 'show'])->name('news.show');

// Public Academy (LMS)
Route::get('/akademi', [\App\Http\Controllers\LmsController::class, 'index'])->name('academy.index');
Route::get('/akademi/{course:slug}', [\App\Http\Controllers\LmsController::class, 'show'])->name('academy.show');
Route::post('/akademi/{course:slug}/enroll', [\App\Http\Controllers\LmsController::class, 'enroll'])->name('academy.enroll');

// Contact Form AJAX Submission Endpoint
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Admin Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Dashboard Routes (Protected by Auth & Admin Middleware)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard main page
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Settings updating
    Route::post('/settings', [AdminDashboardController::class, 'updateSettings'])->name('settings.update');

    // Partners CRUD
    Route::post('/partners', [AdminDashboardController::class, 'storePartner'])->name('partners.store');
    Route::put('/partners/{partner}', [AdminDashboardController::class, 'updatePartner'])->name('partners.update');
    Route::delete('/partners/{partner}', [AdminDashboardController::class, 'destroyPartner'])->name('partners.destroy');

    // Core Values Update
    Route::put('/core-values/{coreValue}', [AdminDashboardController::class, 'updateCoreValue'])->name('core-values.update');

    // Services CRUD
    Route::post('/services', [AdminDashboardController::class, 'storeService'])->name('services.store');
    Route::put('/services/{service}', [AdminDashboardController::class, 'updateService'])->name('services.update');
    Route::delete('/services/{service}', [AdminDashboardController::class, 'destroyService'])->name('services.destroy');

    // Portfolios CRUD
    Route::post('/portfolios', [AdminDashboardController::class, 'storePortfolio'])->name('portfolios.store');
    Route::put('/portfolios/{portfolio}', [AdminDashboardController::class, 'updatePortfolio'])->name('portfolios.update');
    Route::delete('/portfolios/{portfolio}', [AdminDashboardController::class, 'destroyPortfolio'])->name('portfolios.destroy');

    // News/Insights CRUD
    Route::post('/news', [AdminDashboardController::class, 'storeNews'])->name('news.store');
    Route::put('/news/{news}', [AdminDashboardController::class, 'updateNews'])->name('news.update');
    Route::delete('/news/{news}', [AdminDashboardController::class, 'destroyNews'])->name('news.destroy');

    // Contact Inquiries Deletion
    Route::delete('/contacts/{contact}', [AdminDashboardController::class, 'destroyContact'])->name('contacts.destroy');

    // Dynamic MOU Actions
    Route::post('/mous', [MouController::class, 'store'])->name('mous.store');
    Route::delete('/mous/{id}', [MouController::class, 'destroy'])->name('mous.destroy');

    // Dynamic Invoice Actions
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::put('/invoices/{id}/status', [InvoiceController::class, 'updateStatus'])->name('invoices.updateStatus');
    Route::delete('/invoices/{id}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');

    // LMS Management
    Route::get('/lms', [\App\Http\Controllers\Admin\LmsController::class, 'index'])->name('lms.index');
    Route::post('/lms', [\App\Http\Controllers\Admin\LmsController::class, 'store'])->name('lms.store');
    Route::put('/lms/{course}', [\App\Http\Controllers\Admin\LmsController::class, 'update'])->name('lms.update');
    Route::delete('/lms/{course}', [\App\Http\Controllers\Admin\LmsController::class, 'destroy'])->name('lms.destroy');

    Route::post('/lms/{course}/modules', [\App\Http\Controllers\Admin\ModuleController::class, 'store'])->name('lms.modules.store');
    Route::put('/lms/modules/{module}', [\App\Http\Controllers\Admin\ModuleController::class, 'update'])->name('lms.modules.update');
    Route::delete('/lms/modules/{module}', [\App\Http\Controllers\Admin\ModuleController::class, 'destroy'])->name('lms.modules.destroy');

    Route::post('/lms/modules/{module}/lessons', [\App\Http\Controllers\Admin\LessonController::class, 'store'])->name('lms.lessons.store');
    Route::put('/lms/lessons/{lesson}', [\App\Http\Controllers\Admin\LessonController::class, 'update'])->name('lms.lessons.update');
    Route::delete('/lms/lessons/{lesson}', [\App\Http\Controllers\Admin\LessonController::class, 'destroy'])->name('lms.lessons.destroy');
});

// Client Portal Routes (Protected by Auth & Client Middleware)
Route::prefix('portal')->name('portal.')->middleware(['auth', 'role:client'])->group(function () {
    Route::get('/', [\App\Http\Controllers\ClientDashboardController::class, 'index'])->name('dashboard');
    
    // Project Tracking
    Route::get('/projects', [\App\Http\Controllers\ClientProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{project}', [\App\Http\Controllers\ClientProjectController::class, 'show'])->name('projects.show');
    
    // Tickets
    Route::get('/tickets', [\App\Http\Controllers\TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [\App\Http\Controllers\TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [\App\Http\Controllers\TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [\App\Http\Controllers\TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/reply', [\App\Http\Controllers\TicketController::class, 'reply'])->name('tickets.reply');
    
    // Documents
    Route::get('/mous', [\App\Http\Controllers\ClientDocumentController::class, 'mous'])->name('mous');
    Route::get('/invoices', [\App\Http\Controllers\ClientDocumentController::class, 'invoices'])->name('invoices');

    // Academy (Student)
    Route::get('/academy', [\App\Http\Controllers\StudentCourseController::class, 'index'])->name('academy.index');
    Route::get('/academy/learn/{course:slug}/{lesson:slug?}', [\App\Http\Controllers\StudentCourseController::class, 'learn'])->name('academy.learn');
});

// Public Dynamic MOU Signing & Viewing Endpoints
Route::get('/mou/sign/{token}', [MouController::class, 'showSign'])->name('mou.sign');
Route::post('/mou/sign/{token}', [MouController::class, 'sign'])->name('mou.sign.submit');
Route::get('/mou/view/{token}', [MouController::class, 'show'])->name('mou.view');

// Public Dynamic Invoice View & Authenticity QR Verification Endpoints
Route::get('/invoice/view/{token}', [InvoiceController::class, 'show'])->name('invoice.view');
Route::get('/verify/invoice/{token}', [InvoiceController::class, 'verify'])->name('invoice.verify');
