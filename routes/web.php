<?php

use App\Actions\LogoutAction;
use App\Livewire\Admin\Cms\Experiences;
use App\Livewire\Admin\Cms\Hero;
use App\Livewire\Admin\Cms\Projects;
use App\Livewire\Admin\Cms\Tools;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Login;
use App\Livewire\Admin\Messages;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class);

Route::get('/admin/login', Login::class)->name('login')->middleware('guest');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', Dashboard::class)->name('admin.dashboard');
    Route::get('/hero', Hero::class)->name('admin.hero');
    Route::get('/tools', Tools::class)->name('admin.tools');
    Route::get('/projects', Projects::class)->name('admin.projects');
    Route::get('/experiences', Experiences::class)->name('admin.experiences');
    Route::get('/messages', Messages::class)->name('admin.messages');
    Route::get('/transactions', \App\Livewire\Admin\Transactions::class)->name('admin.transactions');
    Route::get('/saving-plans', \App\Livewire\Admin\SavingPlans::class)->name('admin.saving_plans');
    Route::get('/savings', \App\Livewire\Admin\Savings::class)->name('admin.savings');
    Route::get('/allocations', \App\Livewire\Admin\Allocations::class)->name('admin.allocations');

    Route::post('/logout', LogoutAction::class)->name('admin.logout');
});
