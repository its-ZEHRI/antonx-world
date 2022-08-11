<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ route('home') }}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ asset('/images/logo_name_@1x.png') }}"
                    srcset="{{ asset('/images/logo_name_@2x.png 2x') }}" alt="logo">
                <img class="logo-dark logo-img" src="{{ asset('/images/logo_name_@2x.png') }}"
                    srcset="{{ asset('/images/logo_name_@3x.png 2x') }}" alt="logo-dark">
                <img class="logo-small logo-img logo-img-small" src="{{ asset('/images/logo_@1x.png') }}"
                    srcset="{{ asset('/images/logo_@2x.png 2x') }}" alt="logo-small">
            </a>
        </div>
        <div class="nk-menu-trigger mr-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em
                    class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    @auth
                        @if (Auth::user()->role->title == 'Super Admin' || Auth::user()->role->title == 'Admin')
                            <li class="nk-menu-heading">
                                <h6 class="overline-title text-primary-alt">ADMIN DASHBOARD</h6>
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item">
                                <a href="{{ route('home') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon">
                                        <em class="icon ni ni-dashboard"></em>
                                    </span>
                                    <span class="nk-menu-text">Dashboard</span>
                                </a>
                            </li>
                            <!-- .nk-menu-item -->
                            <li class="nk-menu-item has-sub">
                                <?php
                                $book_borrow = \App\Models\BookBorrow::where('request_status', '=', 'pending')->get();
                                $add_book = \App\Models\AddBook::where('request_status', '=', 'pending')->get();
                                $requests = count($book_borrow) + count($add_book);
                                $add_cafe_item = \App\Models\CafeItemRequest::where('request_status', '=', 'pending')->get();
                                ?>
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon">
                                        <em class="icon ni ni-book-read"></em>
                                    </span>
                                    <span class="nk-menu-text d-flex">AntonX Book Club
                                        @if ($requests > 0)
                                            <span class="badge badge-pill badge-danger text-center d-block"
                                                style="width:30px;position:absolute;right: 45px">
                                                {{ $requests }}
                                            </span>
                                        @endif
                                    </span>
                                </a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="{{ route('book') }}" class="nk-menu-link"><span class="nk-menu-text">Book
                                                List</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('category_list') }}" class="nk-menu-link"><span
                                                class="nk-menu-text">Book Categories </span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('borrow_book') }}" class="nk-menu-link">
                                            <span class="nk-menu-text">Book Borrow Request
                                                @if (count($book_borrow) > 0)
                                                    <span class="badge badge-outline-danger text-center d-block"
                                                        style="width:30px;position:absolute;right:15px;top:8px">
                                                        {{ count($book_borrow) }}
                                                    </span>
                                                @endif
                                            </span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('add_book_request') }}" class="nk-menu-link"><span
                                                class="nk-menu-text">Add Book Request
                                                @if (count($add_book) > 0)
                                                    <span class="badge badge-outline-danger text-center d-block"
                                                        style="width:30px;position:absolute;right:15px;top:8px">
                                                        {{ count($add_book) }}
                                                    </span>
                                                @endif
                                            </span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('show_books_with_review') }}" class="nk-menu-link"><span
                                                class="nk-menu-text">Books News Feed
                                            </span></a>
                                    </li>
                                </ul><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item has-sub">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon">
                                        <em class="icon ni ni-cart-fill"></em>
                                    </span>
                                    <span class="nk-menu-text d-flex">AntonX Cafe
                                        @if (count($add_cafe_item) > 0)
                                            <span class="badge badge-pill badge-danger text-center d-block"
                                                style="width:30px;position:absolute;right: 45px">
                                                {{ count($add_cafe_item) }}
                                            </span>
                                        @endif
                                    </span>
                                </a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="{{ route('brand') }}" class="nk-menu-link"><span class="nk-menu-text">Cafe
                                                Item Brand Name</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('item_list') }}" class="nk-menu-link"><span
                                                class="nk-menu-text">Cafe Item List</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('requested_cafe_item_list') }}" class="nk-menu-link"><span
                                                class="nk-menu-text">Add Cafe Item Requests
                                                @if (count($add_cafe_item) > 0)
                                                    <span class="badge badge-outline-danger text-center d-block"
                                                        style="width:30px;position:absolute;right:15px;top:8px">
                                                        {{ count($add_cafe_item) }}
                                                    </span>
                                                @endif
                                            </span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('cafe_item_purchase_history') }}" class="nk-menu-link"><span
                                                class="nk-menu-text">Cafe Item Purchase History</span></a>
                                    </li>
                                </ul><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item -->
                            <!-- .nk-menu-item -->
                            <li class="nk-menu-item has-sub">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                    <span class="nk-menu-text">Users</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="{{ route('user') }}" class="nk-menu-link"><span
                                                class="nk-menu-text">User
                                                List</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('role') }}" class="nk-menu-link">
                                            <span class="nk-menu-text">User Roles List </span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('designation') }}" class="nk-menu-link">
                                            <span class="nk-menu-text">Designation List</span>
                                        </a>
                                    </li>
                                </ul><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item">
                                <a href="{{ route('attendance') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon">
                                        <em class="icon ni ni-note-add-fill"></em></span>
                                    <span class="nk-menu-text">Attendance Logs</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('event') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon">
                                        <em class="icon ni ni-offer-fill"></em></span>
                                    <span class="nk-menu-text">Events List</span>
                                </a>
                            </li>
                            <!-- .nk-menu-item -->
                            <li class="nk-menu-item">
                                <a href="{{ route('featured_user') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon">
                                        <em class="icon ni ni-star-fill"></em></span>
                                    <span class="nk-menu-text">Featured Users</span>
                                </a>
                            </li>
                            <!-- .nk-menu-item -->
                        @else
                        @endif
                    @endauth
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Public Pages</h6>
                    </li><!-- .nk-menu-heading -->
                    <li class="nk-menu-item">
                        <a href="{{ route('Public_leaderboard') }}" class="nk-menu-link">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-box-view-fill"></em></span>
                            <span class="nk-menu-text">Leaderboard</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{ route('mark_attendance_page') }}" class="nk-menu-link">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-calendar-check-fill"></em></span>
                            <span class="nk-menu-text">Mark Attendance </span>
                        </a>
                    </li><!-- .nk-menu-item -->

                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>
