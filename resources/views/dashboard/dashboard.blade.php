@extends('layouts.app')
@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Dashboard</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                {{-- <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="javascript:void(0);" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                        data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <div class="drodown">
                                                    <a href="javascript:void(0);"
                                                        class="dropdown-toggle btn btn-white btn-dim btn-outline-light"
                                                        data-toggle="dropdown"><em
                                                            class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span
                                                                class="d-none d-md-inline">Last</span> 30 Days</span><em
                                                            class="dd-indc icon ni ni-chevron-right"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="javascript:void(0);"><span>Last 30 Days</span></a>
                                                            </li>
                                                            <li><a href="javascript:void(0);"><span>Last 6 Months</span></a>
                                                            </li>
                                                            <li><a href="javascript:void(0);"><span>Last 1 Years</span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="nk-block-tools-opt">
                                                <a href="javascript:void(0);" class="btn btn-primary">
                                                    <em class="icon ni ni-reports"></em>
                                                    <span>Reports</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div> --}}
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-sm-6 col-md-6 col-xxl-3">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Total Checked-In Today</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount d-flex align-center">
                                                        <span id="check_in"> {{ count($total_checkin) }} </span>
                                                        <span class="text-primary px-1" style="font-size: 16px;">Out
                                                            of</span>
                                                        <span id="total_users"> {{ count($total_users) }}</span>
                                                    </div>
                                                    <div class="nk-ecwg6-ck">
                                                        <canvas class="weekly_check_in_out_states_charts"
                                                            id="todayweeklycheckin"></canvas>
                                                    </div>
                                                </div>
                                                <div class="info">
                                                    {{-- {{ $today_change_percent }}
                                                    {{ $yesterday_change_percent }} --}}
                                                    @if (count($total_users) > 0)
                                                        @if ($today_change_checkin > $yesterday_change_checkin)
                                                            <span class="change up text-danger">
                                                                <em class="icon ni ni-arrow-long-up"></em>
                                                                {{ round($today_change_checkin - $yesterday_change_checkin, 2) }}%
                                                            </span>
                                                        @elseif ($today_change_checkin < $yesterday_change_checkin)
                                                            <span class="change down text-danger">
                                                                <em class="icon ni ni-arrow-long-down"></em>
                                                                {{ round($yesterday_change_checkin - $today_change_checkin, 2) }}%
                                                            </span>
                                                        @else
                                                            <span class="change">
                                                                <em class="icon ni ni-activity"></em>
                                                                {{ 0 }}%
                                                            </span>
                                                        @endif
                                                        <span><code> vs </code>yesterday</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->
                                    </div><!-- .nk-ecwg -->
                                </div><!-- .card -->
                            </div><!-- .col -->
                            <div class="col-sm-6 col-md-6 col-xxl-3">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Total Check-Out Today</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount d-flex align-center">
                                                        <span id="check_out"> {{ count($total_checkout) }} </span>
                                                        <span class="text-primary px-1" style="font-size: 16px;">Out
                                                            of</span>
                                                        <span id=""> {{ count($total_checkin) }}</span>

                                                    </div>
                                                    <div class="nk-ecwg6-ck">
                                                        <canvas class="weekly_check_in_out_states_charts"
                                                            id="todayweeklycheckout"></canvas>
                                                    </div>
                                                </div>
                                                <div class="info">
                                                    @if (count($total_users) > 0)
                                                        @if ($today_change_checkout > $yesterday_change_checkout)
                                                            <span class="change up text-danger">
                                                                <em class="icon ni ni-arrow-long-up"></em>
                                                                {{ round($today_change_checkout - $yesterday_change_checkout, 2) }}%
                                                            </span>
                                                        @elseif ($today_change_checkout < $yesterday_change_checkout)
                                                            <span class="change down text-danger">
                                                                <em class="icon ni ni-arrow-long-down"></em>
                                                                {{ round($yesterday_change_checkout - $today_change_checkout, 2) }}%
                                                            </span>
                                                        @else
                                                            <span class="change">
                                                                <em class="icon ni ni-activity"></em>
                                                                {{ 0 }}%
                                                            </span>
                                                        @endif
                                                        <span><code> vs </code>yesterday</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->
                                    </div><!-- .nk-ecwg -->
                                </div><!-- .card -->
                            </div><!-- .col -->

                            <div class="col-12">
                                <h5 class="pt-3">Anton<span class="text-primary">X</span>
                                    Library</h5>
                                <div class="row g-gs">
                                    <div class="col-sm-6 col-md-4">
                                        <div class="card h-100">
                                            <div class="card-inner">
                                                <div class="card-title-group mb-2">
                                                    <div class="card-title">
                                                        <h6 class="title">Anton<span class="text-primary">X</span>
                                                            Library Summary</h6>
                                                    </div>
                                                </div>
                                                <ul class="nk-store-statistics">
                                                    <li class="item">
                                                        <div class="info">
                                                            <div class="title">Total Books</div>
                                                            <div class="count">{{ count($total_books) }}</div>
                                                        </div>
                                                        <em class="icon bg-primary-dim ni ni-book-fill"></em>
                                                    </li>
                                                    <li class="item">
                                                        <div class="info">
                                                            <div class="title">Books Borrowed</div>
                                                            <div class="count">{{ count($total_book_borrowed) }}
                                                            </div>
                                                        </div>
                                                        <em class="icon bg-info-dim ni ni-book-read"></em>
                                                    </li>
                                                    <li class="item">
                                                        <div class="info">
                                                            <div class="title">Total Available Book</div>
                                                            <div class="count">{{ $total_available_book }}</div>
                                                        </div>
                                                        <em class="icon bg-pink-dim ni ni-book"></em>
                                                    </li>
                                                    <li class="item">
                                                        <div class="info">
                                                            <div class="title">Books Categories</div>
                                                            <div class="count">
                                                                {{ count($book_categories) }}</div>
                                                        </div>
                                                        <em class="icon bg-purple-dim ni ni-list-fill"></em>
                                                    </li>
                                                    <li class="item">
                                                        <div class="info">
                                                            <div class="title">New Book Requests</div>
                                                            <div class="count">{{ count($total_book_request) }}</div>
                                                        </div>
                                                        <em class="icon bg-pink-dim ni ni-book-read"></em>
                                                    </li>
                                                </ul>
                                            </div><!-- .card-inner -->
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-sm-12 col-md-8">
                                        <div class="card h-100">
                                            <div class="card-inner card-inner-md p-0">
                                                <div class="nk-msg-body profile-shown">
                                                    <div class="card">
                                                        <div class="card-header d-flex justify-between border-bottom"
                                                            style="background-color:transparent">
                                                            <h6 class="title pt-2"><span>Top 2 Treanding Books</span></h6>
                                                            <span class="date-time pt-1">
                                                                {{ date('d M Y', strtotime(get_date())) }}</span>
                                                        </div>
                                                        <div class="card-inner">
                                                            <div class="row">
                                                                @foreach ($trending_books as $book)
                                                                    <div class="col-6" id="book_row">
                                                                        <div class="w-100 mb-4 d-flex justify-between">
                                                                            <div>
                                                                                <span class="card-title"><b>Book
                                                                                        Title:</b></span>
                                                                                <h6>{{ $book->book->title }}</h6>
                                                                            </div>
                                                                            <div>
                                                                                <span>
                                                                                    <?php
                                                                                    $rating_round = round($book->rating_cnt / $book->cnt, 1);
                                                                                    $rating = floor($rating_round);
                                                                                    $fraction = $rating_round - $rating;
                                                                                    ?>
                                                                                    Rating<br>
                                                                                    @for ($i = 0; $i < $rating; $i++)
                                                                                        <em class="icon ni ni-star-fill"
                                                                                            style="color: #ffd000"></em>
                                                                                    @endfor
                                                                                    @if ($fraction > 0.4)
                                                                                        <em class="icon ni ni-star-half-fill"
                                                                                            style="color: #ffd000"></em>
                                                                                    @endif
                                                                                    @for ($i = 0; $i < 5 - $rating; $i++)
                                                                                        <em class="icon ni ni-star"
                                                                                            style="color: #ffd000"></em>
                                                                                    @endfor
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <span class="card-title"><b>Categories:</b></span>
                                                                        <div class="card-title">
                                                                            @if ($book->book->category_book)
                                                                                @foreach ($book->book->category_book as $cat)
                                                                                    <span
                                                                                        class="badge badge-outline-secondary mb-1 mr-1">
                                                                                        {{ $cat->category_list->title }}</span>
                                                                                @endforeach
                                                                            @else
                                                                                <span>No category added</span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="my-2">
                                                                            <span class="card-title"><b>Summary:</b></span>
                                                                            <p class="card-text">
                                                                                {{ $book->book->summary }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                @endforeach
                                                                {{-- <div class="col-lg-6">
                                                                    <div style="height:320px;width: 200px;">
                                                                        <img src="{{ asset($book->book->book_image) }}"
                                                                            alt="Book Image"
                                                                            style="width: 100%; height:100%;object-fit: cover;" />
                                                                    </div>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- nk-block -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h5>Latest Book Request</h5>
                                <div class="row m-0 nk-download">
                                    <div class="col-12 col-sm-7 col-md-7 data">
                                        <div class="thumb d-none d-sm-block" style="width:6.5rem;"><img
                                                src="{{ asset('public/images/icons/doc-checked.svg') }}" alt="">
                                        </div>
                                        <div class="info">
                                            @if (count($latest_book_request) > 0)
                                                <h6 class="title">
                                                    <span class="text-soft">Book Name: </span>
                                                    <span class="name">{{ $latest_book_request->book_title }}</span>
                                                    <span class="badge badge-dim badge-danger badge-pill">New</span>
                                                </h6>
                                                <div class="meta">
                                                    <span class="version">
                                                        <span class="text-soft">Author: </span>
                                                        <span>{{ $latest_book_request->author }}</span>
                                                    </span>
                                                    <span class="release">
                                                        <span class="text-soft">Requested by: </span>
                                                        <span>{{ $latest_book_request->user->name }}</span>
                                                    </span>
                                                </div>
                                                <div class="meta">
                                                    <span class="version">
                                                        <span class="text-soft">Description: </span>
                                                        <span>{{ $latest_book_request->description }}</span>
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-5 col-md-5 actions text-sm-right">
                                        @if (count($latest_book_request) > 0)
                                            <span class="release">
                                                <span class="text-soft">Book Link: </span>
                                                <a href="{{ $latest_book_request->book_link }}">
                                                    <span>{{ $latest_book_request->book_link }}</span></a>
                                            </span><br>
                                            <span class="text-soft">Added on: </span>
                                            <span>{{ date('jS F Y ', strtotime($latest_book_request->created_at)) }}</span><br>
                                        @endif
                                    </div>
                                </div><!-- .sp-pdl-item -->
                            </div>

                            <div class="col-md-12">
                                <h5 class="pt-3">Anton<span class="text-primary">X</span>
                                    Cafe</h5>
                                <div class="row">
                                    <div class="col-xxl-6 col-md-6">
                                        <div class="card h-100">
                                            <div class="card-inner">
                                                <div class="card-title-group mb-2">
                                                    <div class="card-title">
                                                        <h6 class="title mr-2">Top products
                                                            <span class="badge badge-dim badge-danger badge-pill">Top 3 hot
                                                                itmes</span>
                                                        </h6>
                                                    </div>
                                                </div>
                                                @foreach ($top_3_hot_item as $item_id)
                                                    <div class="nk-download border-bottom px-0">
                                                        <div class="data">
                                                            <div class="thumb"><img
                                                                    src="{{ asset($item_id->item->item_image) }}"
                                                                    alt=""></div>
                                                            <div class="info">
                                                                <h6 class="title"><span
                                                                        class="name">{{ $item_id->item->item_name }}</span>
                                                                </h6>
                                                                <div class="meta">
                                                                    <span class="version">
                                                                        <span class="text-soft">Stock: </span>
                                                                        <span>{{ $item_id->item->stock }}</span>
                                                                    </span>
                                                                    <span class="release">
                                                                        <span class="text-soft">Price: </span>
                                                                        <span><code>Rs.</code>{{ $item_id->item->price }}</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="actions">
                                                            <div class="total text-right">
                                                                <div class="amount">
                                                                    <code>Rs.</code>{{ $item_id->cnt * $item_id->item->price }}
                                                                </div>
                                                                <div class="count">{{ $item_id->cnt }} Sold</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div><!-- .card-inner -->
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-xxl-6 col-md-6">
                                        <div class="card h-100">
                                            <div class="card-inner">
                                                <div class="card-title-group mb-2">
                                                    <div class="card-title">
                                                        <h6 class="title">Anton<span class="text-primary">X </span> Cafe
                                                            Statistics</h6>
                                                    </div>
                                                </div>
                                                <ul class="nk-store-statistics">
                                                    <li class="item">
                                                        <div class="info">
                                                            <div class="title">Total Cafe Products Stock</div>
                                                            <div class="count">{{ $total_cafe_products->sum('stock') }}
                                                            </div>
                                                        </div>
                                                        <em class="icon bg-primary-dim ni ni-bag"></em>
                                                    </li>
                                                    <li class="item">
                                                        <div class="info">
                                                            <div class="title">Total Products Picked</div>
                                                            <div class="count">{{ count($total_product_picked) }}</div>
                                                        </div>
                                                        <em class="icon bg-info-dim ni ni-trend-up"></em>
                                                    </li>
                                                    <li class="item">
                                                        <div class="info">
                                                            <div class="title">Total Products Paid</div>
                                                            <div class="count">{{ count($paid_item) }}</div>
                                                        </div>
                                                        <em class="icon bg-pink-dim ni ni-user-check-fill"></em>
                                                    </li>
                                                    <li class="item">
                                                        <div class="info">
                                                            <div class="title">Total Products Unpaid</div>
                                                            <div class="count">{{ count($unpaid_item) }}</div>
                                                        </div>
                                                        <em class="icon bg-danger-dim ni ni-user-cross-fill"></em>
                                                    </li>
                                                    <li class="item">
                                                        <div class="info">
                                                            <div class="title">Product Categories</div>
                                                            <div class="count">{{ count($cafe_products_categories) }}
                                                            </div>
                                                            {{-- <div class="count">{{ count($total_cafe_products) }}</div> --}}
                                                        </div>
                                                        <em class="icon bg-purple-dim ni ni-server"></em>
                                                    </li>
                                                </ul>
                                            </div><!-- .card-inner -->
                                        </div><!-- .card -->
                                    </div><!-- .col -->


                                </div>
                            </div>
                            <div class="col-md-12">
                                <h5 class="pt-3">Anton<span class="text-primary">X</span>
                                    cafe item getting out of stock</h5>
                                <div class="row m-0 nk-download">
                                    @if (count($getting_out_off_stock_items) > 0)
                                        @foreach ($getting_out_off_stock_items as $item)
                                            <div class="col-12 col-sm-6 col-md-6 mb-1 p-2">
                                                <div class="data border p-3">
                                                    <div class="thumb" style="width: 100px;"><img
                                                            src="{{ asset($item->item_image) }}" alt="">
                                                    </div>
                                                    <div class="info">
                                                        <h6 class="title">
                                                            <span class="text-soft">Item Name: </span>
                                                            <span class="name">{{ $item->item_name }}</span>
                                                            @if ($item->stock == 0)
                                                                <span class="badge badge-dim badge-danger badge-pill">Out
                                                                    of
                                                                    stock</span>
                                                            @endif
                                                        </h6>
                                                        <div class="meta">
                                                            <span class="version">
                                                                <span class="text-soft">Brand Name: </span>
                                                                <span>{{ $item->brand_name }}</span>
                                                            </span>
                                                            <span class="release">
                                                                <span class="text-soft">Item Size: </span>
                                                                <span>{{ $item->size }}</span>
                                                            </span>
                                                        </div>
                                                        <div class="meta">
                                                            <span class="version">
                                                                <span class="text-soft">Remaining Stock: </span>
                                                                <span>{{ $item->stock }}</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="data">
                                            <div class="thumb"><img src="{{ asset('public/images/icons/loop.svg') }}"
                                                    alt=""></div>
                                            <div class="info">
                                                <h6 class="title">
                                                    <span class="name">Cafe Item Stock is Sufficient.</span>
                                                </h6>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12">
                                <h5 class="pt-3">Events <code> Upcoming</code></h5>
                                <div class="row">
                                    @if (count($event_with_attendees) > 0)
                                        @foreach ($event_with_attendees as $event)
                                            <div class="col-12">
                                                <div class="row m-0 nk-download">
                                                    <div class="col-12 col-sm-9 col-md-9 data">
                                                        <div class="thumb"><img
                                                                src="{{ asset('public/images/icons/product-ee.svg') }}"
                                                                alt="">
                                                        </div>
                                                        <?php
                                                        $days = \Carbon\Carbon::now()->diffInDays($event->date, false);
                                                        ?>
                                                        <div class="info">
                                                            <h6 class="title"><span class="text-soft">Event Title:
                                                                </span>
                                                                <span class="name">{{ $event->title }} <code>
                                                                        ({{ $days }} days remaining)
                                                                    </code></span>
                                                            </h6>
                                                            <div class="meta">
                                                                <span class="version">
                                                                    <span class="text-soft">Date/Time: </span>
                                                                    <span>{{ date_with_month_name($event->date) }}
                                                                    </span>
                                                                    <span>{{ show_AM_PM_time($event->event_time) }}</span>
                                                                </span><br>
                                                                <span class="release">
                                                                    <span class="text-soft">Location: </span>
                                                                    <span>{{ $event->location }}</span>
                                                                </span>
                                                            </div>
                                                            <div class="meta">
                                                                <span class="release">
                                                                    <span class="text-soft">Description: </span>
                                                                    <span>{{ $event->description }}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-3 col-md-3 actions d-flex justify-end">
                                                        <ul class="project-users g-1">
                                                            @foreach ($event->attendees as $key => $attendee)
                                                                @if ($key < 4)
                                                                    <li>
                                                                        <div class="user-avatar sm bg-blue">
                                                                            <img src="{{ asset($attendee ? isset($attendee->user->image_url) : '') }}"
                                                                                alt="User"
                                                                                style="width: 100%;height: 100%;border-radius:25%;">
                                                                        </div>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                            @if (count($event->attendees) > 4)
                                                                <li>
                                                                    <div class="user-avatar sm bg-primary"
                                                                        style="border-radius:25%;">
                                                                        +{{ count($event->attendees) - 4 }}
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div><!-- .sp-pdl-item -->
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-xxl-6">
                                            <div class="nk-download">
                                                <div class="data">
                                                    <div class="thumb"><img
                                                            src="{{ asset('public/images/icons/product-cc.svg') }}"
                                                            alt=""></div>
                                                    <div class="info">
                                                        <h6 class="title"><span class="name">NO Event has been added so
                                                                far.</span>
                                                        </h6>
                                                    </div>
                                                </div>

                                            </div><!-- .sp-pdl-item -->
                                        </div>
                                    @endif

                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card card-full">
                                    <div class="nk-ecwg nk-ecwg8 h-100">
                                        <div class="card-inner">
                                            <div class="card-title-group mb-3">
                                                <div class="card-title">
                                                    <h6 class="title">User Attendance Statistics</h6>
                                                </div>
                                                {{-- <div class="card-tools">
                                                <div class="dropdown">
                                                    <a href="javascript:void(0);"
                                                        class="dropdown-toggle link link-light link-sm dropdown-indicator"
                                                        data-toggle="dropdown">Weekly</a>
                                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="javascript:void(0);"><span>Daily</span></a>
                                                            </li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="active"><span>Weekly</span></a></li>
                                                            <li><a href="javascript:void(0);"><span>Monthly</span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            </div>
                                            <ul class="nk-ecwg8-legends">
                                                <li>
                                                    <div class="title">
                                                        <span class="dot dot-lg sq" data-bg="#6576ff"></span>
                                                        <span>Total Present</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">
                                                        <span class="dot dot-lg sq" data-bg="#eb6459"></span>
                                                        <span>Yesterday Presents</span>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="nk-ecwg8-ck">
                                                <canvas class="attendance-stats-chart" id="attendancesstatsid"></canvas>
                                            </div>
                                            <div class="chart-label-group pl-5">
                                                <div class="chart-label">{{ date('d M Y', strtotime($endDate)) }}</div>
                                                <div class="chart-label">{{ date('d M Y', strtotime($startDate)) }}</div>
                                            </div>
                                        </div><!-- .card-inner -->
                                    </div>
                                </div><!-- .card -->
                            </div>

                            <div class="col-12">
                                <div class="card card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Today Active Users List</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-tb-list mt-n2">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col"><span>S/No.</span></div>
                                            <div class="nk-tb-col tb-col-sm"><span>User</span></div>
                                            <div class="nk-tb-col tb-col-md"><span>Check-In Time</span></div>
                                            <div class="nk-tb-col"><span>Check-Out Time</span></div>
                                        </div>
                                        <?php $i = 1; ?>
                                        @foreach ($total_checkin as $active_user)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <span class="tb-lead">{{ $i++ }}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-sm">
                                                    <div class="user-card">
                                                        <div class="user-avatar bg-dark d-none d-sm-flex"
                                                            style="border-radius: 20%">
                                                            <img src="{{ asset($active_user->user->image_url) }}"
                                                                alt="User"
                                                                style="width: 100%; height:100%;object-fit: cover;border-radius: 20%;" />

                                                        </div>
                                                        <div class="user-name">
                                                            <span class="tb-lead">{{ $active_user->user->name }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    <span
                                                        class="tb-sub">{{ show_AM_PM_time($active_user->check_in_time) }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span
                                                        class="tb-sub tb-amount">{{ $active_user->check_out_time ? show_AM_PM_time($active_user->check_out_time) : 'panding' }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div><!-- .card -->
                            </div>

                        </div><!-- .row -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_scripts')
    <script>
        // window.setTimeout(function() {
        //     // var labels = {{ Js::from($chart_labels) }};
        //     // var users = {{ Js::from($chart_checkin_values) }};
        //     // var app1 = @json($total_checkin);
        //     // var app = @json($total_users);
        //     alert(labels);
        // }, 500);



        // values for attendance chart
        var labels = {{ Js::from($dates) }};
        var totalusers = {{ Js::from($count_users) }};
        var users_checkin = {{ Js::from($chart_checkin_values) }};
        var users_checkout = {{ Js::from($chart_checkout_values) }};

        var week_labels = {{ Js::from($weekdates) }};
        var weekly_users_checkin = {{ Js::from($weekly_chart_checkin_values) }};
        var weekly_users_checkout = {{ Js::from($weekly_chart_checkout_values) }};

        "use strict";
        ! function(NioApp, $) {
            "use strict";


            // weekly check in out charts data
            var todayweeklycheckin = {
                labels: week_labels,
                dataUnit: 'Orders',
                lineTension: .3,
                datasets: [{
                    label: "Orders",
                    color: "#854fff",
                    background: "transparent",
                    data: weekly_users_checkin
                }]
            };
            var todayweeklycheckout = {
                labels: week_labels,
                dataUnit: 'Orders',
                lineTension: .3,
                datasets: [{
                    label: "Revenue",
                    color: "#33d895",
                    background: "transparent",
                    data: weekly_users_checkout
                }]
            };

            function weekly_chart_check_in_out(selector, set_data) {
                var $selector = selector ? $(selector) : $('.weekly_check_in_out_states_charts');
                $selector.each(function() {
                    var $self = $(this),
                        _self_id = $self.attr('id'),
                        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data;

                    var selectCanvas = document.getElementById(_self_id).getContext("2d");
                    var chart_data = [];

                    for (var i = 0; i < _get_data.datasets.length; i++) {
                        chart_data.push({
                            label: _get_data.datasets[i].label,
                            tension: _get_data.lineTension,
                            backgroundColor: _get_data.datasets[i].background,
                            borderWidth: 2,
                            borderColor: _get_data.datasets[i].color,
                            pointBorderColor: 'transparent',
                            pointBackgroundColor: 'transparent',
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: _get_data.datasets[i].color,
                            pointBorderWidth: 2,
                            pointHoverRadius: 4,
                            pointHoverBorderWidth: 2,
                            pointRadius: 4,
                            pointHitRadius: 4,
                            data: _get_data.datasets[i].data
                        });
                    }

                    var chart = new Chart(selectCanvas, {
                        type: 'line',
                        data: {
                            labels: _get_data.labels,
                            datasets: chart_data
                        },
                        options: {
                            legend: {
                                display: _get_data.legend ? _get_data.legend : false,
                                rtl: NioApp.State.isRTL,
                                labels: {
                                    boxWidth: 12,
                                    padding: 20,
                                    fontColor: '#6783b8'
                                }
                            },
                            maintainAspectRatio: false,
                            tooltips: {
                                enabled: true,
                                rtl: NioApp.State.isRTL,
                                callbacks: {
                                    title: function title(tooltipItem, data) {
                                        return false;
                                    },
                                    label: function label(tooltipItem, data) {
                                        return data.datasets[tooltipItem.datasetIndex]['data'][
                                            tooltipItem['index']
                                        ] + ' ' + _get_data.dataUnit;
                                    }
                                },
                                backgroundColor: '#1c2b46',
                                titleFontSize: 8,
                                titleFontColor: '#fff',
                                titleMarginBottom: 4,
                                bodyFontColor: '#fff',
                                bodyFontSize: 8,
                                bodySpacing: 4,
                                yPadding: 6,
                                xPadding: 6,
                                footerMarginTop: 0,
                                displayColors: false
                            },
                            scales: {
                                yAxes: [{
                                    display: false,
                                    ticks: {
                                        beginAtZero: false,
                                        fontSize: 12,
                                        fontColor: '#9eaecf',
                                        padding: 0
                                    },
                                    gridLines: {
                                        color: NioApp.hexRGB("#526484", .2),
                                        tickMarkLength: 0,
                                        zeroLineColor: NioApp.hexRGB("#526484", .2)
                                    }
                                }],
                                xAxes: [{
                                    display: false,
                                    ticks: {
                                        fontSize: 12,
                                        fontColor: '#9eaecf',
                                        source: 'auto',
                                        padding: 0,
                                        reverse: NioApp.State.isRTL
                                    },
                                    gridLines: {
                                        color: "transparent",
                                        tickMarkLength: 0,
                                        zeroLineColor: NioApp.hexRGB("#526484", .2),
                                        offsetGridLines: true
                                    }
                                }]
                            }
                        }
                    });
                });
            }
            NioApp.coms.docReady.push(function() {
                weekly_chart_check_in_out();
            });


            // monthly attendance chart data
            var attendancesstatsid = {
                labels: labels,
                dataUnit: 'People',
                lineTension: .4,
                datasets: [{
                        label: "Total Present",
                        color: "#9d72ff",
                        dash: 0,
                        background: NioApp.hexRGB('#9d72ff', .15),
                        data: users_checkin,
                    },
                    {
                        label: "Yesterday Present",
                        color: "#eb6459",
                        dash: [5],
                        background: "transparent",
                        data: users_checkout
                    }
                ]
            };

            function attendanceLineS4(selector, set_data) {
                var $selector = selector ? $(selector) : $('.attendance-stats-chart');
                $selector.each(function() {
                    var $self = $(this),
                        _self_id = $self.attr('id'),
                        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data;

                    var selectCanvas = document.getElementById(_self_id).getContext("2d");
                    var chart_data = [];

                    for (var i = 0; i < _get_data.datasets.length; i++) {
                        chart_data.push({
                            label: _get_data.datasets[i].label,
                            tension: _get_data.lineTension,
                            backgroundColor: _get_data.datasets[i].background,
                            borderWidth: 2,
                            borderDash: _get_data.datasets[i].dash,
                            borderColor: _get_data.datasets[i].color,
                            pointBorderColor: 'transparent',
                            pointBackgroundColor: 'transparent',
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: _get_data.datasets[i].color,
                            pointBorderWidth: 2,
                            pointHoverRadius: 4,
                            pointHoverBorderWidth: 2,
                            pointRadius: 4,
                            pointHitRadius: 4,
                            data: _get_data.datasets[i].data
                        });
                    }

                    var chart = new Chart(selectCanvas, {
                        type: 'line',
                        data: {
                            labels: _get_data.labels,
                            datasets: chart_data
                        },
                        options: {
                            legend: {
                                display: _get_data.legend ? _get_data.legend : false,
                                rtl: NioApp.State.isRTL,
                                labels: {
                                    boxWidth: 12,
                                    padding: 20,
                                    fontColor: '#6783b8'
                                }
                            },
                            maintainAspectRatio: false,
                            tooltips: {
                                enabled: true,
                                rtl: NioApp.State.isRTL,
                                callbacks: {
                                    title: function title(tooltipItem, data) {
                                        return data['labels'][tooltipItem[0]['index']];
                                    },
                                    label: function label(tooltipItem, data) {
                                        return data.datasets[tooltipItem.datasetIndex]['data'][
                                            tooltipItem['index']
                                        ];
                                    }
                                },
                                backgroundColor: '#1c2b46',
                                titleFontSize: 13,
                                titleFontColor: '#fff',
                                titleMarginBottom: 6,
                                bodyFontColor: '#fff',
                                bodyFontSize: 12,
                                bodySpacing: 4,
                                yPadding: 10,
                                xPadding: 10,
                                footerMarginTop: 0,
                                displayColors: false
                            },
                            scales: {
                                yAxes: [{
                                    display: true,
                                    stacked: _get_data.stacked ? _get_data.stacked : false,
                                    position: NioApp.State.isRTL ? "right" : "left",
                                    ticks: {
                                        beginAtZero: true,
                                        fontSize: 11,
                                        fontColor: '#9eaecf',
                                        padding: 10,
                                        callback: function callback(value, index, values) {
                                            return value;
                                        },
                                        min: 0,
                                        stepSize: 3,
                                        max: totalusers
                                    },
                                    gridLines: {
                                        color: NioApp.hexRGB("#526484", .2),
                                        tickMarkLength: 0,
                                        zeroLineColor: NioApp.hexRGB("#526484", .2)
                                    }
                                }],
                                xAxes: [{
                                    display: false,
                                    stacked: _get_data.stacked ? _get_data.stacked : false,
                                    ticks: {
                                        fontSize: 9,
                                        fontColor: '#9eaecf',
                                        source: 'auto',
                                        padding: 10,
                                        reverse: NioApp.State.isRTL
                                    },
                                    gridLines: {
                                        color: "transparent",
                                        tickMarkLength: 0,
                                        zeroLineColor: 'transparent'
                                    }
                                }]
                            }
                        }
                    });
                });
            }
            NioApp.coms.docReady.push(function() {
                attendanceLineS4();
            });

        }(NioApp, jQuery);
    </script>
@endsection
