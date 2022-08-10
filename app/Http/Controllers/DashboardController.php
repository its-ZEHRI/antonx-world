<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AddBook;
use App\Models\Attendance;
use App\Models\Book;
use App\Models\BookBorrow;
use App\Models\BookCategory;
use App\Models\BookReview;
use App\Models\CafeItem;
use App\Models\Event;
use App\Models\FeaturedUser;
use App\Models\PurchaseCafeItemHistory;
use App\Models\QrcodeAccessKey;
use App\Models\Streak;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'AntonX | Admin Dashboard';
        // yesterday date 
        $data['startDate'] = date('Y-m-d', strtotime('-1 days'));
        // last 30th (30 days) date from now 
        $data['endDate'] = date('Y-m-d', strtotime('-31 days'));

        // last week (7 days) date from now 
        $data['weekendDate'] = date('Y-m-d', strtotime('-7 days'));

        // Active In-house User Data
        $data['total_users'] = User::whereNot('id', 1)->whereNot('job_type', 'Remote')->get();

        // Attendance data        
        $data['total_checkin'] = Attendance::with('user')->whereNotNull('check_in_time')->whereNull('check_out_time')->whereDate('date', get_date())->get();
        $data['total_checkout'] = Attendance::whereNotNull('check_in_time')->whereNotNull('check_out_time')->whereDate('date', get_date())->get();

        $data['total_checkin_yesterday'] = Attendance::with('user')->whereNotNull('check_in_time')->whereNull('check_out_time')
            ->whereDate('date', $data['startDate'])->get();
        $data['total_checkout_yesterday'] = Attendance::whereNotNull('check_in_time')->whereNotNull('check_out_time')
            ->whereDate('date', $data['startDate'])->get();

        $data['today_change_checkin'] = 0;
        $data['yesterday_change_checkin'] = 0;

        $data['today_change_checkout'] = 0;
        $data['yesterday_change_checkout'] = 0;

        if (count($data['total_users']) > 0) {
            $data['today_change_checkin'] = count($data['total_checkin']) / count($data['total_users']) * 100;
            $data['yesterday_change_checkin'] = count($data['total_checkin_yesterday']) / count($data['total_users']) * 100;

            $data['today_change_checkout'] = count($data['total_checkout']) / count($data['total_users']) * 100;
            $data['yesterday_change_checkout'] = count($data['total_checkout_yesterday']) / count($data['total_users']) * 100;
        }
        // Cafe Data
        $data['cafe_products_categories'] = CafeItem::get();
        $data['total_cafe_products'] = CafeItem::where('stock', '!=', 0)->get();
        $data['getting_out_off_stock_items'] = CafeItem::where('stock', '<', 3)->get();
        $data['total_product_picked'] = PurchaseCafeItemHistory::get();
        $data['paid_item'] = PurchaseCafeItemHistory::whereNot('price', 0)->get();
        $data['unpaid_item'] = PurchaseCafeItemHistory::where('price', 0)->get();
        $data['top_3_hot_item'] = PurchaseCafeItemHistory::with('item')->select('item_id', DB::raw('COUNT(*) AS cnt'))
            ->groupBy('item_id')->orderByRaw('COUNT(*) DESC')->take(3)->get();

        //AntonX Library Data
        $data['total_books'] = Book::get();
        $data['book_categories'] = BookCategory::get();
        $data['total_book_borrowed'] = BookBorrow::get();
        $data['total_available_book'] = count($data['total_books']) - count($data['total_book_borrowed']);
        $data['latest_book_request'] = AddBook::orderBy('id', 'DESC')->get();
        $data['total_book_request'] = AddBook::where('request_status', '=', 'pending')->get();
        $data['trending_books'] = BookReview::with('book')
            ->select('book_id', 'rating', DB::raw('COUNT(book_id) AS cnt'), DB::raw('sum(rating) AS rating_cnt'))
            ->groupBy('book_id')->orderByRaw('sum(rating) DESC')->take(2)->get();

        //Event Data
        $data['event_with_attendees'] = Event::whereDate('date', '>', get_date())
            ->with(['attendees', 'attendees.user'])->orderBy('date', 'ASC')->take(2)->get();


        // Attendances date for Chart
        $data['attendance_stats'] = Attendance::whereDate('date', '<', $data['startDate'])->whereDate('date', '>', $data['endDate'])
            ->select('date', DB::raw('COUNT(*) AS cnt_users'))
            ->groupBy('date')->orderByRaw('COUNT(*) DESC')->get();
        $attendance_chart_checkin_data = Attendance::whereNotNull('check_in_time')
            ->whereNotNull('check_out_time')->where('date', '>', $data['endDate'])
            ->select('date', DB::raw("COUNT(*) as count"))
            ->groupBy('date')->pluck('count');
        $attendance_chart_checkout_data = Attendance::whereNotNull('check_in_time')
            ->whereNull('check_out_time')->where('date', '>', $data['endDate'])
            ->where('date', '<', $data['startDate'])->select('date', DB::raw("COUNT(*) as count"))
            ->groupBy('date')->pluck('count');

        $data['chart_labels'] =  $data['total_users']->keys();
        $data['chart_checkin_values'] = $attendance_chart_checkin_data->values();
        $data['chart_checkout_values'] = $attendance_chart_checkout_data->values();
        $data['count_users'] = count($data['total_users']);

        // last one month all dates (09 july) for chart labels..!
        $period = CarbonPeriod::create($data['endDate'], $data['startDate']);
        $data['dates'] =  collect($period)->map(function ($item, $key) {
            return date('d F', strtotime($item));
        })->all();


        // total check in and check out weekly charts data
        $total_weekly_checkin_data = Attendance::whereNotNull('check_in_time')
            ->whereNotNull('check_out_time')->where('date', '>', $data['weekendDate'])
            ->select('date', DB::raw("COUNT(*) as count"))
            ->groupBy('date')->pluck('count');
        $total_weekly_checkout_data = Attendance::whereNotNull('check_in_time')
            ->whereNull('check_out_time')->where('date', '>', $data['weekendDate'])
            ->where('date', '<', $data['startDate'])->select('date', DB::raw("COUNT(*) as count"))
            ->groupBy('date')->pluck('count');

        $data['weekly_chart_checkin_values'] = $total_weekly_checkin_data->values();
        $data['weekly_chart_checkout_values'] = $total_weekly_checkout_data->values();

        // last week all dates (09 july) for chart labels..!
        $week_period = CarbonPeriod::create($data['weekendDate'], get_date());
        $data['weekdates'] =  collect($week_period)->map(function ($item, $key) {
            return date('d F', strtotime($item));
        })->all();


        // dd(request()->getSchemeAndHttpHost());


        return view('dashboard.dashboard', $data);
    }

    // public function leaderboard_user_details()
    // {
    //     $featured_users = FeaturedUser::with('user')->get();

    //     // yesterday date 
    //     $startDate = date('Y-m-d', strtotime('-1 days'));
    //     // last 30th (30 days) date from now 
    //     $endDate = date('Y-m-d', strtotime('-31 days'));
    //     // show attendance statistic from now to last 30 days
    //     $current_hours = Attendance::selectRaw('sum(total_hours_inSec) as seconds')
    //         ->whereDate('date', '>', $endDate)->whereDate('date', '<', get_date())
    //         ->whereColumn('user_id', 'users.id')
    //         ->getQuery();
    //     $users = User::with('user_streak')->whereNotIn('id', array(1))->select('users.*')
    //         ->selectSub($current_hours, 'seconds')
    //         ->orderBy('seconds', 'DESC')
    //         ->get();
    //     $access_token = QrcodeAccessKey::select('access_key')->where('id', 1)->get()[0];
    //     $data = ['users' => $users, 'featured_users' => $featured_users, 'access_token' => $access_token];

    //     return view('leaderboard.leaderboard', $data);
    // }
}
