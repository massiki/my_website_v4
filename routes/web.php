<?php

use App\Livewire\Auth\Login;
use App\Livewire\Frontend\AboutPage;
use App\Livewire\Frontend\ContactPage;
use App\Livewire\Frontend\HomePage;
use App\Livewire\Frontend\ProjectDetailPage;
use App\Livewire\Frontend\ProjectsPage;
use App\Livewire\Frontend\ServicesPage;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\ManageHomeContent;
use App\Livewire\Admin\ManageServices;
use App\Livewire\Admin\ManageProjects;
use App\Livewire\Admin\ManageAbout;
use App\Livewire\Admin\ManageContactInfo;
use App\Livewire\Admin\ManageMessages;
use App\Livewire\Admin\ManageTechnologies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ── Frontend ──────────────────────────────────
Route::get('/',              HomePage::class)->name('home');
Route::get('/services',      ServicesPage::class)->name('services');
Route::get('/projects',      ProjectsPage::class)->name('projects');
Route::get('/projects/{slug}', ProjectDetailPage::class)->name('projects.show');
Route::get('/about',         AboutPage::class)->name('about');
Route::get('/contact',       ContactPage::class)->name('contact');

// ── Auth ──────────────────────────────────────
Route::get('/login',  Login::class)->name('login')->middleware('guest');
Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('home');
})->name('logout')->middleware('auth');

// ── Admin ─────────────────────────────────────
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/',              Dashboard::class)->name('admin.dashboard');
    Route::get('/home-content',  ManageHomeContent::class)->name('admin.home');
    Route::get('/services',      ManageServices::class)->name('admin.services');
    Route::get('/projects',      ManageProjects::class)->name('admin.projects');
    Route::get('/technologies',  ManageTechnologies::class)->name('admin.technologies');
    Route::get('/about',         ManageAbout::class)->name('admin.about');
    Route::get('/contact-info',  ManageContactInfo::class)->name('admin.contact');
    Route::get('/messages',      ManageMessages::class)->name('admin.messages');
});
