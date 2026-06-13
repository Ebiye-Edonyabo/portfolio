<?php

use App\Actions\LogoutAction;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Experiences;
use App\Livewire\Admin\Hero;
use App\Livewire\Admin\Login;
use App\Livewire\Admin\Messages;
use App\Livewire\Admin\Projects;
use App\Livewire\Admin\Tools;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class);

Route::get('/admin/login', Login::class)->name('login')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('/admin', Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/hero', Hero::class)->name('admin.hero');
    Route::get('/admin/tools', Tools::class)->name('admin.tools');
    Route::get('/admin/projects', Projects::class)->name('admin.projects');
    Route::get('/admin/experiences', Experiences::class)->name('admin.experiences');
    Route::get('/admin/messages', Messages::class)->name('admin.messages');

    Route::post('/admin/logout', LogoutAction::class)->name('admin.logout');
});
