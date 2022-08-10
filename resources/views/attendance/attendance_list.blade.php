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
                                    <h4 class="nk-block-title">User Attendance List</h4>
                                </div>
                                <div class="nk-block-head-content d-flex align-end">
                                    <form method="get" id="users_report_form" action="{{ route('export_users') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-4 align-end">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="date">Year<code>*</code></label>
                                                    <div class="form-control-wrap">
                                                        <input type="date" min="2020" class="form-control"
                                                            id="date" name="date" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success">Get Report</button>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <a class="btn btn-primary" href="javascript:show_form();">
                                        <em class="icon ni ni-plus"></em> Add User Attendance</a>
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
                                        <th class="nk-tb-col tb-col-md"><span>Action</span></th>
                                    </tr><!-- .nk-tb-item -->
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    // echo $attendance;
                                    // die();
                                    ?>
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
                                                    <div class="user-avatar bg-dark d-none d-sm-flex">
                                                        <img src="{{ asset($attend->user->image_url ? $attend->user->image_url : '') }}"
                                                            alt="User"
                                                            style="width: 100%; height:100%;object-fit: cover;" />
                                                    </div>
                                                    <div class="user-info">
                                                        <span
                                                            class="tb-lead">{{ $attend->user->name ? $attend->user->name : '' }}<span
                                                                class="dot dot-success d-md-none ml-1"></span></span>
                                                        <span>{{ $attend->user->email ? $attend->user->email : '' }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="nk-tb-col">
                                                <span>{{ date_with_slash($attend->date) }}</span>
                                            </td>
                                            <td class="nk-tb-col">
                                                @if (empty($attend->check_out_time))
                                                    <span class="badge badge-danger"> {{ 'absent' }}</span>
                                                @else
                                                    <span
                                                        class="tb-lead">{{ show_AM_PM_time($attend->check_in_time) }}</span>
                                                @endif
                                            </td>
                                            <td class="nk-tb-col">
                                                @if (empty($attend->check_out_time))
                                                    <span class="badge badge-warning"> {{ ' ' }}</span>
                                                @else
                                                    <span class="tb-lead">
                                                        {{ show_AM_PM_time($attend->check_out_time) }}</span>
                                                @endif
                                            </td>
                                            <td class="nk-tb-col tb-col-md">
                                                <span class="tb-sub">{{ $attend->month }}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-md">
                                                {{-- <span
                                                    class="tb-lead">{{ difference_bwt_two_times($t1, $t2) }}</span> --}}
                                                <span
                                                    class="tb-lead">{{ show_only_HHMM($attend->total_hours_inSec) }}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-md">
                                                <a href="{{ url('user_view/' . $attend->user_id) }}"
                                                    class="btn p-1 btn-primary">
                                                    <em class="icon ni ni-eye"></em>
                                                </a>
                                                <button title="Edit" class="btn p-1 btn-warning edit_attend"
                                                    onclick="edit_attend(this);" id="{{ $attend->id }}"
                                                    value="{{ $attend->id }}"><em class="icon ni ni-edit"></em></button>
                                                <button title="Delete" class="btn p-1 btn-danger"
                                                    onclick="delete_attend(this);" value="{{ $attend->id }}"><em
                                                        class="icon ni ni-trash"></em></button>

                                            </td>
                                        </tr><!-- .nk-tb-item -->
                                    @endforeach
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

        function show_form() {
            let data = new FormData();
            data.append('id', '');
            data.append('_token', '{{ csrf_token() }}');

            function a() {
                modal_size();
            }
            arr = [a];
            call_ajax_modal_with_functions('{{ route('attendance_form') }}', data, 'Add User Attendance', arr);

        }

        function save_attendance() {
            let form = document.getElementById('attendance_form');
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
            call_ajax_with_functions('', '{{ route('attendance_save') }}', data, arr);
        }

        function edit_attend(me) {
            let id = me.value;
            let data = new FormData();
            data.append('id', id);
            data.append('_token', "{{ csrf_token() }}");

            function a() {
                modal_size();
            }
            arr = [a];
            call_ajax_modal_with_functions('{{ route('attendance_form') }}', data, 'Edit Attendance', arr);
        }

        function view_attend(me) {
            let id = me.value;
            let data = new FormData();
            data.append('id', id);
            data.append('_token', "{{ csrf_token() }}");

            function a() {
                modal_size();
            }
            arr = [a];
            call_ajax_modal_with_functions('{{ route('attendance_view') }}', data, 'Attendance Details', arr);
        }

        function delete_attend(me) {
            let id = me.value;
            let data = new FormData();
            data.append('id', id);
            data.append('_token', "{{ csrf_token() }}");
            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this record? <br>You will not be able to recover this.",
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
                    call_ajax('', '{{ route('attendance_delete') }}', data);
                }
            })
        }
    </script>
@endsection
