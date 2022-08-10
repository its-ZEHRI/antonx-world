<?php

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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

Route::get('/clear-cache', function () {
    Cache::flush();
    return 'Routes cache cleared';
});

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes([
    'register' => false
]);

// Public Leader Board Routes 
Route::get('/Public_leaderboard', [App\Http\Controllers\LeaderboardController::class, 'index'])->name('Public_leaderboard');


Route::middleware(\App\Http\Middleware\EnsureLogin::class)->group(function () {

    Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');

    //Route::group(['middleware' => 'auth','middleware' => 'role'], function () {} 
    // Routes for permitted Roles user can access....
    Route::group(['middleware' => 'role'], function () {
        // route for report generating.......
        Route::get('export_users', [App\Http\Controllers\AttendanceController::class, 'export'])->name('export_users');

        // User routes______________
        Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
        Route::get('/user_view/{id}', [App\Http\Controllers\UserController::class, 'view'])->name('user_view');

        Route::get('/user_form', [App\Http\Controllers\UserController::class, 'user_form'])->name('user_form');
        Route::get('/user_edit_form/{id}', [App\Http\Controllers\UserController::class, 'user_form'])->name('user_edit_form');

        Route::post('/user_save', 'App\Http\Controllers\UserController@save')->name('user_save');
        Route::post('/user_delete', 'App\Http\Controllers\UserController@delete')->name('user_delete');
        Route::post('/view_user', 'App\Http\Controllers\UserController@view_By_Date')->name('view_user');
        Route::post('/user_report', 'App\Http\Controllers\UserController@user_report')->name('user_report');

        Route::post('/user_password_form', 'App\Http\Controllers\UserController@user_password_form')->name('user_password_form');
        Route::post('/change_password', 'App\Http\Controllers\UserController@change_password')->name('change_password');

        Route::post('userCompany_form', [App\Http\Controllers\UserCompanyController::class, 'userCompany_form'])->name('userCompany_form');
        Route::post('save_user_company_info', [App\Http\Controllers\UserCompanyController::class, 'save_userCompany'])->name('save_user_company_info');

        Route::post('/pay_bill_form', [App\Http\Controllers\UserController::class, 'pay_bill_form'])->name('pay_bill_form');
        Route::post('/update_cafe_bill', [App\Http\Controllers\UserController::class, 'update_cafe_bill'])->name('update_cafe_bill');

        Route::get('/deleted_users', [App\Http\Controllers\UserController::class, 'deleted_users'])->name('deleted_users');
        Route::post('/user_restore', [App\Http\Controllers\UserController::class, 'restore_softdeleted'])->name('user_restore');
        Route::post('/delete_permanently', [App\Http\Controllers\UserController::class, 'delete_permanently'])->name('delete_permanently');

        // User designations routes______________
        Route::get('/designation', [App\Http\Controllers\UserDesignationController::class, 'index'])->name('designation');
        Route::get('/deleted_designation_list', [App\Http\Controllers\UserDesignationController::class, 'deleted_list'])->name('deleted_designation_list');
        Route::post('/designation_form', 'App\Http\Controllers\UserDesignationController@designation_form')->name('designation_form');
        Route::post('/designation_save', 'App\Http\Controllers\UserDesignationController@store')->name('designation_save');
        Route::post('/designation_delete', 'App\Http\Controllers\UserDesignationController@delete')->name('designation_delete');
        Route::post('/designation_delete_undo', 'App\Http\Controllers\UserDesignationController@restore_deleted_record')->name('designation_delete_undo');
        Route::post('/designation_delete_permanently', 'App\Http\Controllers\UserDesignationController@delete_permanently')->name('designation_delete_permanently');

        // User Roles routes______________
        Route::get('/role', [App\Http\Controllers\RolesController::class, 'index'])->name('role');
        Route::post('/role_form', 'App\Http\Controllers\RolesController@role_form')->name('role_form');
        Route::post('/role_save', 'App\Http\Controllers\RolesController@store')->name('role_save');
        Route::post('/role_delete', 'App\Http\Controllers\RolesController@delete')->name('role_delete');

        // Book routes______________
        Route::get('/book', [App\Http\Controllers\BookController::class, 'index'])->name('book');
        Route::get('/show_books_with_review', [App\Http\Controllers\BookController::class, 'show_books_with_review'])->name('show_books_with_review');
        Route::post('/book_form', 'App\Http\Controllers\BookController@book_form')->name('book_form');
        Route::post('/book_save', 'App\Http\Controllers\BookController@store')->name('book_save');
        Route::post('/book_delete', 'App\Http\Controllers\BookController@delete')->name('book_delete');
        Route::post('/add_category_for_book', 'App\Http\Controllers\BookController@add_category_for_book')->name('add_category_for_book');
        // Route::post('/add_category', [App\Http\Controllers\BookController::class, 'add_category'])->name('add_category');

        // Book Category routes______________
        Route::get('/category_list', [App\Http\Controllers\BookCategoryController::class, 'index'])->name('category_list');
        Route::post('/book_category_form', 'App\Http\Controllers\BookCategoryController@book_category_form')->name('book_category_form');
        Route::post('/book_category_save', 'App\Http\Controllers\BookCategoryController@store')->name('book_category_save');
        Route::post('/book_category_delete', 'App\Http\Controllers\BookCategoryController@delete')->name('book_category_delete');

        // Add Book request routes______________
        Route::get('/add_book_request', [App\Http\Controllers\AddBookRequestController::class, 'index'])->name('add_book_request');
        Route::post('/book_request_form', 'App\Http\Controllers\AddBookRequestController@book_request_form')->name('book_request_form');
        Route::post('/save_request_remark', 'App\Http\Controllers\AddBookRequestController@save_request_remark')->name('save_request_remark');
        Route::post('/book_request_delete', 'App\Http\Controllers\AddBookRequestController@delete')->name('book_request_delete');

        // Borrow Book Request routes______________
        Route::get('/borrow_book', [App\Http\Controllers\BookBorrowController::class, 'index'])->name('borrow_book');
        Route::post('/borrow_book_detail', [App\Http\Controllers\BookBorrowController::class, 'form'])->name('borrow_book_detail');
        Route::post('/borrow_book_remark', [App\Http\Controllers\BookBorrowController::class, 'save_remarks'])->name('borrow_book_remark');

        // AntonX Cafe routes______________
        Route::get('/item_list', [App\Http\Controllers\CafeController::class, 'index'])->name('item_list');
        Route::post('/cafe_item_form', [App\Http\Controllers\CafeController::class, 'form'])->name('cafe_item_form');
        Route::post('/cafe_item_save', [App\Http\Controllers\CafeController::class, 'save'])->name('cafe_item_save');
        Route::post('/cafe_item_delete', [App\Http\Controllers\CafeController::class, 'delete'])->name('cafe_item_delete');
        Route::get('/cafe_item_purchase_history', [App\Http\Controllers\CafeController::class, 'purchase_history'])->name('cafe_item_purchase_history');

        // Cafe Item Brand Name routes______________
        Route::get('/brand', [App\Http\Controllers\cafeItemBrandNameController::class, 'index'])->name('brand');
        Route::post('/brand_form', 'App\Http\Controllers\cafeItemBrandNameController@brand_form')->name('brand_form');
        Route::post('/brand_save', 'App\Http\Controllers\cafeItemBrandNameController@store')->name('brand_save');
        Route::post('/brand_delete', 'App\Http\Controllers\cafeItemBrandNameController@delete')->name('brand_delete');


        // Add Item to cafe request routes______________
        Route::get('/requested_cafe_item_list', [App\Http\Controllers\CafeItemRequestController::class, 'index'])->name('requested_cafe_item_list');
        Route::post('/item_request_details', 'App\Http\Controllers\CafeItemRequestController@request_form_with_details')->name('item_request_details');
        Route::post('/save_cafe_request_remark', 'App\Http\Controllers\CafeItemRequestController@save_request_remark')->name('save_cafe_request_remark');
        Route::post('/request_cafe_item_delete', 'App\Http\Controllers\CafeItemRequestController@delete')->name('request_cafe_item_delete');




        // featured_user routes______________
        Route::get('/featured_user', [App\Http\Controllers\FeaturedUserController::class, 'index'])->name('featured_user');
        Route::post('/feature_user_form', 'App\Http\Controllers\FeaturedUserController@featured_user_form')->name('feature_user_form');
        Route::post('/feature_user_save', 'App\Http\Controllers\FeaturedUserController@save')->name('feature_user_save');
        Route::post('/feature_user_delete', 'App\Http\Controllers\FeaturedUserController@delete')->name('feature_user_delete');

        // User Attendance routes for admin______________
        Route::get('/attendance', [App\Http\Controllers\AttendanceController::class, 'index'])->name('attendance');
        Route::post('/attendance_form', 'App\Http\Controllers\AttendanceController@attendance_form')->name('attendance_form');
        Route::post('/attendance_save', 'App\Http\Controllers\AttendanceController@save')->name('attendance_save');
        Route::post('/attendance_view', 'App\Http\Controllers\AttendanceController@view')->name('attendance_view');
        Route::post('/attendance_delete', 'App\Http\Controllers\AttendanceController@delete')->name('attendance_delete');

        // Events routes for admin______________
        Route::get('/event', [App\Http\Controllers\EventController::class, 'index'])->name('event');
        Route::post('/event_filter', [App\Http\Controllers\EventController::class, 'index'])->name('event_filter');
        Route::post('/event_form', 'App\Http\Controllers\EventController@show_form')->name('event_form');
        Route::post('/event_save', 'App\Http\Controllers\EventController@save')->name('event_save');
        Route::post('/event_view', 'App\Http\Controllers\EventController@view')->name('event_view');
        Route::post('/event_delete', 'App\Http\Controllers\EventController@delete')->name('event_delete');
        Route::post('/save_event_attendees', 'App\Http\Controllers\EventController@save_event_attendee')->name('save_event_attendees');



        // dummy route for report page for redesigning in case:
        Route::get('users_report', function () {
            $date = Carbon::createFromFormat('Y/m/d', '2022/06/04');
            $monthly_working_hours = get_month_days($date->month, $date->year) * 8;
            // show Users attendance statistic report
            $current_hours = Attendance::selectRaw('sum(total_hours_inSec) as seconds')
                ->whereMonth('date', $date->month)->whereYear('date', $date->year)
                ->whereColumn('user_id', 'users.id')
                ->getQuery();
            $users = User::whereNotIn('id', array(1))->select('users.*')
                ->selectSub($current_hours, 'seconds')
                ->orderBy('seconds', 'desc')
                ->get();
            $data = [
                'users' => $users,
                'monthly_working_hours' => $monthly_working_hours,
                'date' => $date,
            ];
            return view('user.users_report', $data);
        });
    });

    // attendance routes for user
    Route::get('/mark_attendance_page', [App\Http\Controllers\AttendanceController::class, 'single_user_attendance_list'])->name('mark_attendance_page');
    Route::post('/userMarkAttendance', [App\Http\Controllers\AttendanceController::class, 'user_mark_attendance'])->name('userMarkAttendance');
});
