{{-- <img src="{{ asset('images/' . $user->image) }}" alt="User" style="width: 100%; height:100%;object-fit: cover;" /> --}}
@extends('layouts.app')
@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">User <span class="text-danger">></span> <strong
                                        class="text-primary small">{{ $user->name }}</strong></h3>
                                <div class="nk-block-des text-soft">
                                    <ul class="list-inline">
                                        <li>User ID: <span class="text-base">{{ $user->atn_number }}</span></li>
                                        <li>Last Login:
                                            @foreach ($user->attendances as $last_login)
                                                @if ($loop->last)
                                                    <span class="text-base">
                                                        {{ date('d M Y', strtotime($last_login->date)) . ' ' }}
                                                        {{ ' ' . $last_login->check_in_time }}
                                                    </span>
                                                @endif
                                            @endforeach
                                        </li>
                                    </ul>
                                </div>
                                <div class="nk-block-des text-soft">
                                    <ul class="list-inline">
                                        <li>Total Purchases: <span class="text-base">{{ count($user->purchases) }}</span>
                                        </li>
                                        <li>Cafe Bill: <span class="text-base">{{ $user->cafe_bill }}</span></li>

                                    </ul>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ url()->previous() }}"
                                    class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em
                                        class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                <a href="{{ url()->previous() }}"
                                    class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em
                                        class="icon ni ni-arrow-left"></em></a>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card">
                            <div class="card-aside-wrap">
                                <div class="card-content">
                                    <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#personal_info_tab"><em
                                                    class="icon ni ni-user-circle"></em><span>Personal</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#attendance_history_tab"><em
                                                    class="icon ni ni-activity"></em><span>Attendance History</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#featured_user"><em
                                                    class="icon ni ni-file-text"></em><span>Featured User</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#purchase_history"><em
                                                    class="icon ni ni-chart"></em><span>Cafe Puchase History</span></a>
                                        </li>
                                        <li class="nav-item nav-item-trigger d-xxl-none">
                                            <a href="#" class="toggle btn btn-icon btn-trigger"
                                                data-target="userAside"><em class="icon ni ni-user-list-fill"></em></a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="personal_info_tab">
                                            <div class="card-inner p-0">
                                                <div class="nk-block p-4">
                                                    <div class="nk-block-head">
                                                        <h6 class="title">Personal Information</h6>
                                                    </div><!-- .nk-block-head -->
                                                    <div class="profile-ud-list">
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Title</span>
                                                                @if ($user->gender == 'Female')
                                                                    <span class="profile-ud-value">Ms.</span>
                                                                @elseif($user->gender == 'Male')
                                                                    <span class="profile-ud-value">Mr.</span>
                                                                @else
                                                                    <span class="profile-ud-value">Mr/Ms.</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Full Name</span>
                                                                <span class="profile-ud-value">{{ $user->name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Date of Birth</span>
                                                                <span
                                                                    class="profile-ud-value">{{ isset($user->date_of_birth) ? date_with_month_name($user->date_of_birth) : 'nill' }}</span>

                                                            </div>
                                                        </div>
                                                        {{-- <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Surname</span>
                                                                <span class="profile-ud-value">
                                                                    {{ isset($user->name) ? get_last_name($user->name) : $user->name }}
                                                                </span>
                                                            </div>
                                                        </div> --}}
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Mobile Number</span>
                                                                <span class="profile-ud-value">{{ $user->contact }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Email Address</span>
                                                                <span class="profile-ud-value">{{ $user->email }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Current Address</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $user->current_address }}</span>
                                                            </div>
                                                        </div>
                                                    </div><!-- .profile-ud-list -->
                                                </div><!-- .nk-block -->
                                                <div class="nk-block p-4">
                                                    <div class="nk-block-head nk-block-head-line">
                                                        <h6 class="title overline-title text-base">Additional Information
                                                        </h6>
                                                    </div><!-- .nk-block-head -->
                                                    <div class="profile-ud-list">
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Joining Date</span>
                                                                <span
                                                                    class="profile-ud-value">{{ date_with_month_name($user->created_at) }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Reg Method</span>
                                                                <span class="profile-ud-value">ATN Number</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Country</span>
                                                                <span class="profile-ud-value">Pakistan</span>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Nationality</span>
                                                                <span class="profile-ud-value">Pakistani</span>
                                                            </div>
                                                        </div> --}}
                                                    </div><!-- .profile-ud-list -->
                                                </div><!-- .nk-block -->
                                                <div class="nk-block p-4">
                                                    <div class="nk-block-head nk-block-head-line">
                                                        <h6 class="title overline-title text-base">Educational Information
                                                        </h6>
                                                    </div><!-- .nk-block-head -->
                                                    <div class="profile-ud-list">
                                                        @foreach ($user->education as $education)
                                                            <div class="profile-ud-item d-flex">
                                                                <em class="icon ni ni-book-fill"
                                                                    style="font-size: 25px;"></em>
                                                                <div class="profile-ud wider pt-0 pl-2 pb-3"
                                                                    style="display: grid !important">

                                                                    <span
                                                                        class="profile-ud-value text-left">{{ $education->degree }}</span>
                                                                    <span
                                                                        class="profile-ud-value text-left">{{ $education->institute }}</span>
                                                                    <span
                                                                        class="profile-ud-label text-left w-100">{{ date('Y', strtotime($education->startDate)) }}
                                                                        -
                                                                        {{ $education->endDate ? date('Y', strtotime($education->endDate)) : '-' }}</span>

                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div><!-- .profile-ud-list -->
                                                </div><!-- .nk-block -->
                                                <div class="nk-block p-4">
                                                    <div class="nk-block-head nk-block-head-line">
                                                        <div class="d-flex align-items-baseline">
                                                            <h6 class="title overline-title text-base mr-2">AntonX Journey
                                                            </h6>
                                                            <div>
                                                                <button title="Add New Designation"
                                                                    class="btn p-0  btn-primary"
                                                                    onclick="show_form(this);" id="{{ $user->id }}"
                                                                    value="{{ $user->id }}">
                                                                    <em class="icon ni ni-plus"></em>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div><!-- .nk-block-head -->
                                                    <div class="profile-ud-list">
                                                        <div class="profile-ud-item">
                                                            @foreach ($user->company as $company)
                                                                <div class="d-flex w-75 justify-between mb-2">
                                                                    <div class="d-flex">
                                                                        <em class="icon ni ni-tag-fill"
                                                                            style="font-size: 25px;"></em>
                                                                        <div class="profile-ud wider pt-0 pl-2 pb-3"
                                                                            style="display: grid !important">
                                                                            <span
                                                                                class="profile-ud-value text-left">{{ $company->designation }}</span>
                                                                            <span
                                                                                class="profile-ud-label text-left w-100">{{ date('m Y', strtotime($company->startDate)) }}
                                                                                -
                                                                                {{ $company->endDate ? date('m Y', strtotime($company->endDate)) : ' present' }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <button title="Edit"
                                                                            class="btn p-0 text-warning edit_user"
                                                                            onclick="edit_form(this);"
                                                                            id="{{ $company->id }}"
                                                                            value="{{ $company->id }}"><em
                                                                                class="icon ni ni-edit"></em></button>
                                                                    </div>

                                                                </div>
                                                            @endforeach
                                                        </div>

                                                    </div><!-- .profile-ud-list -->
                                                </div><!-- .nk-block -->
                                                <div class="nk-block p-4">
                                                    <div class="nk-block-head nk-block-head-line">
                                                        <h6 class="title overline-title text-base">Social Links
                                                        </h6>
                                                    </div><!-- .nk-block-head -->
                                                    <div class="profile-ud-list">
                                                        <div class="profile-ud-item">
                                                            @foreach ($user->user_social_links as $link)
                                                                <div class="d-flex">
                                                                    <em class="icon ni ni-link"
                                                                        style="font-size: 25px;"></em>
                                                                    <div class="profile-ud wider pt-0 pl-2 pb-3 mr-5"
                                                                        style="display: grid !important">
                                                                        <span class="profile-ud-value text-left">
                                                                            {{ $link->site_name }}</span>
                                                                        <a href="{{ $link->social_profile_link }}">
                                                                            <span class="profile-ud-value text-left">
                                                                                {{ $link->social_profile_link }}</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div><!-- .profile-ud-list -->
                                                </div><!-- .nk-block -->
                                                <div class="nk-divider divider md"></div>
                                            </div><!-- .card-inner -->
                                        </div>
                                        <div class="tab-pane" id="attendance_history_tab">
                                            <div class="nk-block p-4">
                                                <form method="post" action="{{ route('view_user') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row g-4">
                                                        @if ($user)
                                                            <input type="hidden" value="{{ $user->id }}"
                                                                name="id">
                                                        @endif
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="date">Select Start
                                                                    Date</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="Date" class="form-control"
                                                                        id="date" name="start_date"
                                                                        value="{{ $filters ? $filters[0] : '' }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="date">Select End
                                                                    Date</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="Date" class="form-control"
                                                                        id="date" name="end_date"
                                                                        value="{{ $filters ? $filters[1] : '' }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-4 d-flex"
                                                            style="justify-content: right">
                                                            <div class="form-group">
                                                                <label class="form-label pt-2"></label>
                                                                <div class="form-control-wrap">
                                                                    <button type="submit" class="btn btn-primary">Filter
                                                                        Attendance</button>
                                                                    <a href="{{ url('user_view/' . $user->id) }}"
                                                                        class="btn p-1 btn-danger">
                                                                        clear filter
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="nk-block p-4">
                                                <table class="datatable-init nowrap nk-tb-list is-separate"
                                                    data-auto-responsive="false">
                                                    <thead>
                                                        <tr class="nk-tb-item nk-tb-head">
                                                            <th class="nk-tb-col tb-col-sm"><span>S.No</span></th>
                                                            <th class="nk-tb-col"><span class="sub-text">User</span>
                                                            </th>
                                                            <th class="nk-tb-col"><span>Date</span></th>
                                                            <th class="nk-tb-col"><span>Check In</span></th>
                                                            <th class="nk-tb-col"><span>Check Out</span></th>
                                                            <th class="nk-tb-col tb-col-md"><span>Month</span></th>
                                                            <th class="nk-tb-col tb-col-md"><span>Total Logged Hours</span>
                                                            </th>
                                                        </tr><!-- .nk-tb-item -->
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        @if ($filters)
                                                            @foreach ($attendance as $attend)
                                                                <?php
                                                                $t1 = $attend->check_in_time;
                                                                $t2 = $attend->check_out_time;
                                                                ?>
                                                                <tr class="nk-tb-item">
                                                                    <td class="nk-tb-col tb-col-sm">
                                                                        <span>{{ $i++ }}</span>
                                                                    </td>
                                                                    <td class="nk-tb-col">
                                                                        <div class="user-card">
                                                                            <div
                                                                                class="user-avatar bg-dark d-none d-sm-flex">

                                                                                <img src="{{ asset($attend->user->image_url) }}"
                                                                                    alt="User"
                                                                                    style="width: 100%; height:100%;object-fit: cover;" />
                                                                            </div>
                                                                            <div class="user-info">
                                                                                <span
                                                                                    class="tb-lead">{{ $attend->user->name }}<span
                                                                                        class="dot dot-success d-md-none ml-1"></span></span>
                                                                                <span>{{ $attend->user->email }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="nk-tb-col">
                                                                        <span>{{ $attend->date }}</span>
                                                                    </td>
                                                                    <td class="nk-tb-col">
                                                                        <span
                                                                            class="tb-lead">{{ show_AM_PM_time($attend->check_in_time) }}</span>
                                                                    </td>
                                                                    @if (empty($attend->check_out_time))
                                                                        <td class="nk-tb-col">
                                                                            <span class="badge badge-warning">
                                                                                {{ 'pending' }}</span>
                                                                        </td>
                                                                    @else
                                                                        <td class="nk-tb-col">
                                                                            <span class="tb-lead">
                                                                                {{ show_AM_PM_time($attend->check_out_time) }}</span>
                                                                        </td>
                                                                    @endif
                                                                    <td class="nk-tb-col tb-col-md">
                                                                        <span class="tb-sub">{{ $attend->month }}</span>
                                                                    </td>
                                                                    <td class="nk-tb-col tb-col-md">
                                                                        <span
                                                                            class="tb-lead">{{ difference_bwt_two_times($t1, $t2) }}</span>
                                                                    </td>
                                                                </tr><!-- .nk-tb-item -->
                                                            @endforeach
                                                        @else
                                                            @foreach ($user->attendances as $attend)
                                                                <?php
                                                                $t1 = $attend->check_in_time;
                                                                $t2 = $attend->check_out_time;
                                                                ?>
                                                                <tr class="nk-tb-item">
                                                                    <td class="nk-tb-col tb-col-sm">
                                                                        <span>{{ $i++ }}</span>
                                                                    </td>
                                                                    <td class="nk-tb-col">
                                                                        <div class="user-card">
                                                                            <div
                                                                                class="user-avatar bg-dark d-none d-sm-flex">
                                                                                <img src="{{ asset($attend->user->image_url) }}"
                                                                                    alt="User"
                                                                                    style="width: 100%; height:100%;object-fit: cover;" />
                                                                            </div>
                                                                            <div class="user-info">
                                                                                <span
                                                                                    class="tb-lead">{{ $attend->user->name }}<span
                                                                                        class="dot dot-success d-md-none ml-1"></span></span>
                                                                                <span>{{ $attend->user->email }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="nk-tb-col">
                                                                        <span>{{ $attend->date }}</span>
                                                                    </td>
                                                                    <td class="nk-tb-col">
                                                                        <span
                                                                            class="tb-lead">{{ show_AM_PM_time($attend->check_in_time) }}</span>
                                                                    </td>
                                                                    @if (empty($attend->check_out_time))
                                                                        <td class="nk-tb-col">
                                                                            <span class="badge badge-warning">
                                                                                {{ 'pending' }}</span>
                                                                        </td>
                                                                    @else
                                                                        <td class="nk-tb-col">
                                                                            <span class="tb-lead">
                                                                                {{ show_AM_PM_time($attend->check_out_time) }}</span>
                                                                        </td>
                                                                    @endif
                                                                    <td class="nk-tb-col tb-col-md">
                                                                        <span class="tb-sub">{{ $attend->month }}</span>
                                                                    </td>
                                                                    <td class="nk-tb-col tb-col-md">
                                                                        <span
                                                                            class="tb-lead">{{ difference_bwt_two_times($t1, $t2) }}</span>
                                                                    </td>
                                                                </tr><!-- .nk-tb-item -->
                                                            @endforeach
                                                        @endif

                                                    </tbody>
                                                </table><!-- .nk-tb-list -->
                                            </div>
                                            <!-- .nk-block -->
                                        </div>
                                        <div class="tab-pane" id="featured_user">
                                            <div class="nk-block p-4">
                                                <div class="nk-block-head">
                                                    <h6 class="title">Featured User Information</h6>
                                                </div><!-- .nk-block-head -->
                                            </div>
                                            <div class="nk-block p-4">
                                                <table class="datatable-init nowrap nk-tb-list is-separate"
                                                    data-auto-responsive="false">
                                                    <thead>
                                                        <tr class="nk-tb-item nk-tb-head">
                                                            <th class="nk-tb-col tb-col-sm"><span>S.No</span></th>
                                                            <th class="nk-tb-col"><span class="sub-text">User</span></th>
                                                            <th class="nk-tb-col tb-col-md"><span>Description</span></th>
                                                        </tr><!-- .nk-tb-item -->
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        @foreach ($user->featured_user as $feature)
                                                            <tr class="nk-tb-item">
                                                                <td class="nk-tb-col tb-col-sm">
                                                                    <span>{{ $i++ }}</span>
                                                                </td>
                                                                <td class="nk-tb-col">
                                                                    <div class="user-card">
                                                                        <div class="user-avatar bg-dark d-none d-sm-flex">
                                                                            <img src="{{ asset($feature->user->image_url) }}"
                                                                                alt="User"
                                                                                style="width: 100%; height:100%;object-fit: cover;" />
                                                                        </div>
                                                                        <div class="user-info">
                                                                            <span
                                                                                class="tb-lead">{{ $feature->user->name }}<span
                                                                                    class="dot dot-success d-md-none ml-1"></span></span>
                                                                            <span>{{ $feature->user->email }}</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="nk-tb-col">
                                                                    <span
                                                                        class="tb-lead">{{ Str::of($feature->description)->words(7, ' . . . ') }}</span>
                                                                </td>
                                                            </tr><!-- .nk-tb-item -->
                                                        @endforeach
                                                    </tbody>
                                                </table><!-- .nk-tb-list -->
                                            </div>
                                            <!-- .nk-block -->
                                        </div>
                                        <div class="tab-pane" id="purchase_history">
                                            <div class="nk-block p-4">
                                                <table class="datatable-init nowrap nk-tb-list is-separate"
                                                    data-auto-responsive="false">
                                                    <thead>
                                                        <tr class="nk-tb-item nk-tb-head">
                                                            <th class="nk-tb-col tb-col-sm"><span>S.No</span></th>
                                                            <th class="nk-tb-col"><span class="sub-text">Item</span>
                                                            </th>
                                                            <th class="nk-tb-col"><span>Price</span></th>
                                                            <th class="nk-tb-col"><span>Date/Time</span></th>
                                                            </th>
                                                        </tr><!-- .nk-tb-item -->
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        @foreach ($user->purchases as $item)
                                                            <tr class="nk-tb-item">
                                                                <td class="nk-tb-col tb-col-sm">
                                                                    <span>{{ $i++ }}</span>
                                                                </td>
                                                                <td class="nk-tb-col">
                                                                    <div class="user-card">
                                                                        <div class="user-avatar bg-dark d-none d-sm-flex">
                                                                            <img src="{{ asset($item->item->item_image) }}"
                                                                                alt="User"
                                                                                style="width: 100%; height:100%;object-fit: cover;" />
                                                                        </div>
                                                                        <div class="user-info">
                                                                            <span
                                                                                class="tb-lead">{{ $item->item->brand_name }}<span
                                                                                    class="dot dot-success d-md-none ml-1"></span></span>
                                                                            <span>{{ $item->item->size }}</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="nk-tb-col">
                                                                    <span>{{ $item->price }}</span>
                                                                </td>
                                                                <td class="nk-tb-col">
                                                                    <span
                                                                        class="tb-lead">{{ parse_datetime_get($item->item->created_at) }}</span>
                                                                </td>
                                                            </tr><!-- .nk-tb-item -->
                                                        @endforeach


                                                    </tbody>
                                                </table><!-- .nk-tb-list -->
                                            </div>
                                            <!-- .nk-block -->
                                        </div>
                                    </div>

                                </div><!-- .card-content -->
                                <div class="card-aside card-aside-right user-aside toggle-slide toggle-slide-right toggle-break-xxl"
                                    data-content="userAside" data-toggle-screen="xxl" data-toggle-overlay="true"
                                    data-toggle-body="true">
                                    <div class="card-inner-group" data-simplebar>
                                        <div class="card-inner">
                                            <div class="user-card user-card-s2">
                                                <div class="user-avatar lg bg-primary">
                                                    <span style="width: 90px;height:90px;"><img
                                                            src="{{ asset($user->image_url) }}" alt="User"
                                                            style="width: 100%; height:100%;object-fit: cover;" /></span>
                                                </div>
                                                <div class="user-info">
                                                    <div class="badge badge-outline-light badge-pill ucap">
                                                        {{ isset($user->role->title) ? $user->role->title : 'Developer' }}
                                                    </div>
                                                    <h5>{{ $user->name }}</h5>
                                                    <span class="sub-text">{{ $user->email }}</span>
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->

                                        <!-- .card-inner -->
                                        <div class="card-inner">
                                            <div class="row text-center">
                                                <div class="col-4">
                                                    <div class="profile-stats">
                                                        <span
                                                            class="amount">{{ get_month_days(get_month(), get_year()) * 8 }}</span>
                                                        <span class="sub-text">Expected Hours</span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="profile-stats">
                                                        <span class="amount">
                                                        </span>
                                                        <span class="amount">{{ seconds_to_hours($seconds) }}</span>
                                                        <span class="sub-text">Logged-in Hours</span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="profile-stats">
                                                        <span
                                                            class="amount">{{ get_month_days(get_month(), get_year()) * 8 - seconds_to_hours($seconds) }}</span>
                                                        <span class="sub-text">Remaining Hours</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->
                                        <div class="card-inner">
                                            <h6 class="overline-title-alt mb-2">Additional</h6>
                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <span class="sub-text">User ID:</span>
                                                    <span>UD00-{{ $user->id }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="sub-text">Last Login:</span>
                                                    @foreach ($user->attendances as $last_login)
                                                        @if ($loop->last)
                                                            <span
                                                                class="text-base">{{ $last_login->date . ' ' . $last_login->check_in_time }}</span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="col-6">
                                                    <span class="sub-text">KYC Status:</span>
                                                    <span class="lead-text text-success">Approved</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="sub-text">Register At:</span>
                                                    <span>{{ date_with_month_name($user->joining_date) }}</span>
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->

                                    </div><!-- .card-inner -->
                                </div><!-- .card-aside -->
                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <script>
        function modal_size() {
            $('.modal-dialog').removeClass('modal-sm');
            $('.modal-dialog').addClass('modal-lg');
        }

        function enable_cb() {
            if (this.checked) {
                $("#endDate").attr("disabled", true);
            } else {
                $("#endDate").removeAttr("disabled");
            }
        }

        function show_form(me) {
            let user_id = me.value;
            let data = new FormData();
            data.append('user_id', user_id);
            data.append('_token', '{{ csrf_token() }}');

            function a() {
                modal_size();
                enable_cb();
                $("#customCheck2").click(enable_cb);
            }

            arr = [a];
            call_ajax_modal_with_functions('{{ route('userCompany_form') }}', data, 'Add User Company Info', arr);
        }

        function userCompany_save() {
            let form = document.getElementById('userCompany_form');
            let data = new FormData(form);
            let a = function() {
                $('#background_fade_form').fadeOut(function() {
                    $(this).remove();
                });
            }
            let b = function() {
                window.location.reload();
            }
            let arr = [a, b];
            call_ajax_with_functions('', '{{ route('save_user_company_info') }}', data, arr);
        }


        function edit_form(me) {
            let id = me.value;
            let data = new FormData();
            data.append('id', id);
            data.append('_token', "{{ csrf_token() }}");

            function a() {
                modal_size();
                enable_cb();
                $("#customCheck2").click(enable_cb);
            }
            arr = [a];
            call_ajax_modal_with_functions('{{ route('userCompany_form') }}', data, 'Edit User Company Info', arr);
        }

        function delete_user(me) {
            let id = me.value;
            let data = new FormData();
            data.append('id', id);
            data.append('_token', "{{ csrf_token() }}");
            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this record? You will not be able to recover this.",
                icon: "warning",
                buttons: [
                    'No, cancel it!',
                    'Yes, I am sure!'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $(me).closest('tr').fadeOut('slow', function() {
                        $(this).remove();
                    });
                    window.location.reload();
                    call_ajax('', '{{ route('user_delete') }}', data);
                }
            })
        }

        function pay_bill_form(me) {
            let id = me.value;
            let data = new FormData();
            data.append('id', id);
            data.append('_token', "{{ csrf_token() }}");

            function a() {
                $('.modal-dialog').addClass('modal-md');
                only_digits();
            }
            arr = [a];
            call_ajax_modal_with_functions('{{ route('pay_bill_form') }}', data, 'Pay Cafe Bill', arr);
        }

        function update_cafe_bill() {
            if ($('#pass').val() !== $('#c_pass').val()) {
                $('#pass_response').fadeIn();
                return;
            }
            let form = document.getElementById('cafe_bill_form');
            let data = new FormData(form);
            let a = function() {
                $('#background_fade_form').fadeOut(function() {
                    $(this).remove();
                });
            }
            let b = function() {
                window.location.reload();
            }
            let arr = [a, b];
            call_ajax_with_functions('', '{{ route('update_cafe_bill') }}', data, arr);

        }
    </script>
@endsection
