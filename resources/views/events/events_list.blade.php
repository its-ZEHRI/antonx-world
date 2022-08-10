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
                                    <h4 class="nk-block-title">Events List <code> (Showing {{ $v }}) </code></h4>
                                </div>
                                <div class="nk-block-head-content">
                                    <div class="toggle-wrap nk-block-tools-toggle">
                                        <a href="javascript:void(0);" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                            data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                        <div class="toggle-expand-content" data-content="pageMenu">
                                            <ul class="nk-block-tools g-3">
                                                <li>
                                                    <div class="drodown">
                                                        <a href="javascript:void(0);"
                                                            class="dropdown-toggle btn btn-white btn-dim btn-outline-light"
                                                            data-toggle="dropdown"><em
                                                                class="d-none d-sm-inline icon ni ni-filter"></em><span>
                                                                <span class="d-none d-md-inline">Filter</span> Event
                                                                List</span><em
                                                                class="dd-indc icon ni ni-chevron-down"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li>
                                                                    <form method="post"
                                                                        action="{{ route('event_filter') }}"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input type="hidden" value="all" name="filter">
                                                                        <button type="submit" class="btn px-0 w-100">
                                                                            <a class="w-100 "><span>Show All</span></a>
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                                <li>
                                                                    <form method="post"
                                                                        action="{{ route('event_filter') }}"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input type="hidden" value="upcoming"
                                                                            name="filter">
                                                                        <button type="submit" class="btn px-0 w-100">
                                                                            <a class="w-100 "><span>upcoming</span></a>
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                                <li>
                                                                    <form method="post"
                                                                        action="{{ route('event_filter') }}"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input type="hidden" value="past" name="filter">
                                                                        <button type="submit" class="btn px-0 w-100">
                                                                            <a class="w-100 "><span>Past</span></a>
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                                <li>
                                                                    <a class="text-danger" href="{{ route('event') }}">
                                                                        Clear Filter</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="nk-block-tools-opt">
                                                    <a class="btn btn-primary" href="javascript:show_form();">
                                                        <em class="icon ni ni-plus"></em> Add Event</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head-content -->
                            </div>
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="nk-tb-list is-separate nk-tb-ulist datatable-init table">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col nk-tb-col-check">
                                                    <div class="">
                                                        <span>S.no</span>
                                                    </div>
                                                </th>
                                                <th class="nk-tb-col"><span class="sub-text">Event Name</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Location</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Time &
                                                        Date</span></th>
                                                <th class="nk-tb-col tb-col-lg">
                                                    <span class="sub-text">Attendees</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Action</span>
                                                </th>
                                            </tr><!-- .nk-tb-item -->
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($event_users as $event)
                                                <tr class="nk-tb-item">
                                                    <td class="nk-tb-col nk-tb-col-check">
                                                        <div class="">
                                                            <span>{{ $i++ }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <a href="0;" class="project-title">
                                                            <div class="project-info">
                                                                <h6 class="title">{{ $event->title }}</h6>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-lg">
                                                        <span>{{ $event->location }}</span>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-lg">
                                                        <span>
                                                            <span>{{ show_AM_PM_time($event->event_time) }}</span><br>
                                                            <span>{{ date_with_month_name($event->date) }}</span>

                                                        </span>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-lg">
                                                        <style>
                                                            .project-users li {
                                                                margin-left: -20px;
                                                            }

                                                            .project-users li:nth-child(1) {
                                                                margin-left: 0px;
                                                            }

                                                            .project-users li:nth-child(n+5) {
                                                                margin-left: 0px;
                                                            }
                                                        </style>
                                                        <ul class="project-users g-1">
                                                            @foreach ($event->attendees as $key => $attendee)
                                                                @if ($key < 4)
                                                                    <li>
                                                                        <div class="user-avatar sm bg-blue">
                                                                            @if ($attendee->user->image_url != null)
                                                                                <img src="{{ asset($attendee->user->image_url ? $attendee->user->image_url : '') }}"
                                                                                    alt="User"
                                                                                    style="width: 100%;height: 100%;border-radius:25%;">
                                                                            @endif
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
                                                    </td>
                                                    <td class="nk-tb-col tb-col-mb">

                                                        {{-- <button title="Attend" class="btn p-1 btn-success"
                                                            onclick="save_event_attendee(this);"
                                                            id="{{ Auth::user()->id }}"
                                                            value="{{ $event->id }}">Attend</button> --}}
                                                        <button title="Edit" class="btn p-1 btn-warning edit_event"
                                                            onclick="edit_event(this);" id="{{ $event->id }}"
                                                            value="{{ $event->id }}">
                                                            <em class="icon ni ni-edit"></em>
                                                        </button>
                                                        <button title="Delete" class="btn p-1 btn-danger"
                                                            onclick="delete_event(this);" value="{{ $event->id }}">
                                                            <em class="icon ni ni-trash"></em>
                                                        </button>
                                                    </td>
                                                </tr><!-- .nk-tb-item -->
                                            @endforeach
                                        </tbody>
                                    </table><!-- .nk-tb-list -->
                                </div>
                            </div><!-- .card-preview -->
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
            call_ajax_modal_with_functions('{{ route('event_form') }}', data, 'Add Events', arr);

        }

        function save_event() {
            let form = document.getElementById('event_form');
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
            call_ajax_with_functions('', '{{ route('event_save') }}', data, arr);
        }

        function edit_event(me) {
            let id = me.value;
            let data = new FormData();
            data.append('id', id);
            data.append('_token', "{{ csrf_token() }}");

            function a() {
                modal_size();
            }
            arr = [a];
            call_ajax_modal_with_functions('{{ route('event_form') }}', data, 'Edit Event', arr);
        }

        function delete_event(me) {
            let id = me.value;
            let data = new FormData();
            data.append('id', id);
            data.append('_token', "{{ csrf_token() }}");
            var b = function() {
                window.location.reload();
            }
            let arr = [b];
            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this record? \n You will not be able to recover this.",
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
                    call_ajax_with_functions('', '{{ route('event_delete') }}', data, arr);
                }
            })
        }

        function save_event_attendee(me) {
            let user_id = me.id;
            let event_id = me.value;
            let data = new FormData();
            data.append('event_id', event_id);
            data.append('user_id', user_id);
            data.append('_token', "{{ csrf_token() }}");
            var b = function() {
                window.location.reload();
            }
            let arr = [b];
            Swal.fire({
                title: 'Event Attendees',
                text: 'Do you want to attend this event',
                icon: 'warning',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                denyButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    call_ajax_with_functions('', '{{ route('save_event_attendees') }}', data, arr);
                }
            })
        }
    </script>
@endsection
