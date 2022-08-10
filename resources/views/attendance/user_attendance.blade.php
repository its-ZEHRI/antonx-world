@extends('layouts.app')
@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview ">
                        <div class="nk-block nk-block-lg">
                            <div class="nk-block-between mb-4">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">Mark Attendance </h4>
                                </div>
                                <div class="nk-block-head-content">
                                    <ul class="preview-list">
                                        <li class="preview-item">
                                            <form method="post" id="user_attendance_check_in_form"
                                                action="javascript:check_in_time();">
                                                @csrf
                                                <input type="hidden" value="true" name="isCheckin">
                                                <input type="hidden" value="{{ Auth::user()->id }}" name="id">
                                                <button type="submit" class="btn btn-primary" onclick="check_in_time();">
                                                    <em class="icon ni ni-clock"></em> CHECK IN </button>
                                            </form>
                                        </li>
                                        <li class="preview-item">
                                            <form method="post" id="user_attendance_check_out_form"
                                                action="javascript:check_out_time();">
                                                @csrf
                                                <input type="hidden" value="false" name="isCheckin">
                                                <input type="hidden" value="{{ Auth::user()->id }}" name="id">
                                                <button type="submit" class="btn btn-primary" onclick="check_out_time();">
                                                    <em class="icon ni ni-clock"></em> CHECK OUT </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <table class="datatable-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
                                <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                        <th class="nk-tb-col tb-col-sm"><span>S.No</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">User</span></th>
                                        <th class="nk-tb-col"><span>Date</span></th>
                                        <th class="nk-tb-col"><span>Check In</span></th>
                                        <th class="nk-tb-col"><span>Check Out</span></th>
                                        <th class="nk-tb-col tb-col-md"><span>Month</span></th>
                                        <th class="nk-tb-col tb-col-md"><span>Total Logged Hours</span></th>
                                        <th class="nk-tb-col tb-col-md"><span>Status</span></th>
                                    </tr><!-- .nk-tb-item -->
                                </thead>
                                <tbody>
                                    @if($user)
                                        <?php $i = 1; ?>
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
                                                        <div class="user-avatar bg-dark d-none d-sm-flex">
                                                            <img src="{{ asset($attend->user->image_url) }}" alt="User"
                                                                style="width: 100%; height:100%;object-fit: cover;" />
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="tb-lead">{{ $attend->user->name }}<span
                                                                    class="dot dot-success d-md-none ml-1"></span></span>
                                                            <span>{{ $attend->user->email }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <span>{{ $attend->date }}</span>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <span class="tb-lead">{{ $attend->check_in_time }}</span>
                                                </td>
                                                @if (empty($attend->check_out_time))
                                                    <td class="nk-tb-col">
                                                        <span class="badge badge-warning"> {{ 'pending' }}</span>
                                                    </td>
                                                @else
                                                    <td class="nk-tb-col">
                                                        <span class="tb-lead">
                                                            {{ $attend->check_out_time }}</span>
                                                    </td>
                                                @endif
                                                <td class="nk-tb-col tb-col-md">
                                                    <span class="tb-sub">{{ $attend->month }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span
                                                        class="tb-lead">{{ difference_bwt_two_times($t1, $t2) }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span class="tb-sub">{{ $attend->attendance_status }}</span>
                                                </td>
                                            </tr><!-- .nk-tb-item -->
                                        @endforeach
                                    @endif
                                </tbody>
                            </table><!-- .nk-tb-list -->
                        </div> <!-- nk-block -->
                    </div><!-- .components-preview -->
                </div>
            </div>
        </div>
    </div>



    <script>
        function modal_size() {
            $('.modal-dialog').removeClass('modal-sm');
            $('.modal-dialog').addClass('modal-xl');
        }

        function check_in_time() {
            let form = document.getElementById('user_attendance_check_in_form');
            let data = new FormData(form);
            let today = new Date();
            let time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var b = function() {
                // window.location.reload();
            }
            let arr = [b];
            Swal.fire({
                title: 'Welcome Back',
                text: 'Check in time : ' + time,
                icon: 'info',
                confirmButtonText: 'Check In!',
            }).then((result) => {
                if (result.isConfirmed) {
                    call_ajax_with_functions('', '{{ route('userMarkAttendance') }}', data, arr);
                }
            })
        }

        function check_out_time() {
            let form = document.getElementById('user_attendance_check_out_form');
            let data = new FormData(form);
            var today = new Date();
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var b = function() {
                window.location.reload();
            }
            let arr = [b];
            Swal.fire({
                title: 'Do you want to check out?',
                text: 'Check out time : ' + time,
                icon: 'warning',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Check out!',
                denyButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    call_ajax_with_functions('', '{{ route('userMarkAttendance') }}', data, arr);
                }
            })
        }
    </script>
@endsection
