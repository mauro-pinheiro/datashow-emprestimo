<?php

use App\Http\Livewire\ClientIndex;
use App\Http\Livewire\ClientSave;
use App\Http\Livewire\PermissionCreateForm;
use App\Http\Livewire\PermissionIndex;
use App\Http\Livewire\PermissionSave;
use App\Http\Livewire\RoleIndex;
use App\Http\Livewire\RoleSave;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
//     return view('home');
// })->name('home');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::view('/home', 'home')->name('home');
    Route::get('roles', RoleIndex::class)->name('roles.index');
    Route::get('roles/create', RoleSave::class)->name('roles.create');
    Route::get('roles/edit/{role}', RoleSave::class)->name('roles.edit');
    Route::get('permissions', PermissionIndex::class)->name('permissions.index');
    Route::get('permissions/create', PermissionSave::class)->name('permissions.create');
    Route::get('permissions/edit/{permission}', PermissionSave::class)->name('permissions.edit');
    Route::get('clientes', ClientIndex::class)->name('clients.index');
    Route::get('clientes/create', ClientSave::class)->name('clients.create');
    Route::get('clientes/edit/{client}', ClientSave::class)->name('clients.edit');
});

