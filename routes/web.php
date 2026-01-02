<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/',[LoginController::class, 'index']);
Route::post('login',[LoginController::class, 'login'])->name('login');
Route::get('logout',[LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:Admin,Organizer,Attendee'])->group(function(){
    Route::resource('event',EventController::class);
    Route::get('getCity', [EventController::class, 'getCity'])->name('getCity');
    Route::get('filterData', [EventController::class, 'filterData'])->name('filterData');
});

Route::middleware(['auth', 'role:Admin,Organizer'])->group(function(){
    Route::get('organizer_index', [EventController::class, 'organizerIndex'])->name('organizer_index');
    Route::get('softdeleted', [EventController::class,'softDeleted'])->name('softdeleted');
    Route::get('event/{id}/restore', [EventController::class,'restore'])->name('restore');
    Route::delete('event/{id}/force_delete', [EventController::class,'forceDelete'])->name('force_delete');
});

Route::middleware(['auth', 'role:Admin,Attendee'])->group(function(){
    Route::get('register_index',[RegisterController::class,'index'])->name('register.index');
    Route::get('register_create',[RegisterController::class,'create'])->name('register.create');
    Route::post('register_store',[RegisterController::class,'store'])->name('register.store');

    Route::get('getTicketType', [RegisterController::class, 'getTicketType'])->name('getTicketType');
    Route::get('getQuantity', [RegisterController::class, 'getQuantity'])->name('getQuantity');
    Route::post('payment', [RegisterController::class, 'payment'])->name('payment');
    Route::get('ticket_pdf/{id}', [RegisterController::class, 'ticket_pdf'])->name('ticket_pdf');
});

Route::middleware(['auth', 'role:Admin,Speaker'])->group(function(){
    Route::get('speaker_index',[EventController::class,'speakerIndex'])->name('speaker_index');
    Route::get('speaker_report',[EventController::class,'speakerReport'])->name('speaker_report');
});
Route::middleware(['auth', 'role:Admin'])->group(function(){
    Route::get('event_report',[EventController::class, 'eventReport'])->name('event_report');
    Route::get('event/{id}/revenue_pdf',[EventController::class, 'revenueReport'])->name('revenue_pdf');
});
