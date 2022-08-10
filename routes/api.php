<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1'], function () {
    Route::post('login_by_api', [App\Http\Controllers\Auth\LoginController::class, 'login_by_api'])->name('login_by_api');
});

Route::middleware('auth:api')->prefix('v1')->group(function () {

    // user route
    Route::get('get_user_info', [App\Http\Controllers\Api\UserController::class, 'find_user'])->name('find_user');
    Route::get('users_list', [App\Http\Controllers\Api\UserController::class, 'users_list'])->name('users_list');
    Route::get('user_additional_information', [App\Http\Controllers\Api\UserController::class, 'user_profile'])->name('user_additional_information');

    // user Education route
    Route::post('user_education_create', [App\Http\Controllers\Api\UserEducationController::class, 'save_user_education'])->name('user_education_create');

    // user Link route
    Route::post('user_link_create', [App\Http\Controllers\Api\UserLinkController::class, 'save_user_link'])->name('user_link_create');

    // user Company/Designation route
    Route::post('user_company_create', [App\Http\Controllers\Api\UserCompanyController::class, 'save_user_company'])->name('user_company_create');

    // Featured User routes
    Route::get('featured_users_and_Events_list', [App\Http\Controllers\Api\FeaturedUserController::class, 'index'])->name('featured_users_and_Events_list');

    // leader_board route
    Route::get('leader_board', [App\Http\Controllers\Api\LeaderboardController::class, 'index'])->name('leader_board');

    // Events routes for admin
    Route::get('event_list', [App\Http\Controllers\Api\EventController::class, 'index'])->name('event_list');
    Route::post('attend_event', [App\Http\Controllers\Api\EventController::class, 'save_event_attendee'])->name('attend_event');

    // User Attendance routes
    Route::post('check_in_check_out', [App\Http\Controllers\Api\AttendanceController::class, 'check_in_check_out'])->name('check_in_check_out');

    // Add Table Tennis Score routes
    Route::post('add_table_tennis_score', [App\Http\Controllers\Api\TableTennisController::class, 'save'])->name('add_table_tennis_score');
    Route::get('get_table_tennis_score', [App\Http\Controllers\Api\TableTennisController::class, 'index'])->name('get_table_tennis_score');

    // Book routes
    Route::get('show_book', [App\Http\Controllers\Api\BookController::class, 'index'])->name('show_book');
    Route::post('add_book_review', [App\Http\Controllers\Api\BookReviewController::class, 'add_book_review'])->name('add_book_review');
    Route::post('book_borrow_request', [App\Http\Controllers\Api\BookBorrowController::class, 'book_borrow_request'])->name('book_borrow_request');
    Route::post('add_new_book_request', [App\Http\Controllers\Api\AddBookRequestController::class, 'add_book_request'])->name('add_new_book_request');

    // Cafe routes
    Route::get('show_cafe_items', [App\Http\Controllers\Api\CafeController::class, 'index'])->name('show_cafe_items');
    Route::post('purchase_item', [App\Http\Controllers\Api\CafeController::class, 'purchase_item'])->name('purchase_item');
    Route::post('purchase_item_by_cash', [App\Http\Controllers\Api\CafeController::class, 'purchase_item_by_cash'])->name('purchase_item_by_cash');
    Route::get('purchase_history', [App\Http\Controllers\Api\CafeController::class, 'purchase_history'])->name('purchase_history');
    Route::get('payable_amount', [App\Http\Controllers\Api\CafeItemRequestController::class, 'payable_amount'])->name('payable_amount');

    Route::post('add_cafe_item_request', [App\Http\Controllers\Api\CafeItemRequestController::class, 'save'])->name('add_cafe_item_request');
    Route::get('show_cafe_item_requests', [App\Http\Controllers\Api\CafeItemRequestController::class, 'requests_list'])->name('show_cafe_item_requests');
});
