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
                                    <h4 class="nk-block-title">Disabled Users List</h4>
                                </div>
                                <div class="nk-block-head-content">
                                    <a href="{{ url()->previous() }}"
                                        class="btn py-0 px-1 btn-outline-light bg-white d-none d-sm-inline-flex"><em
                                            class="icon ni ni-arrow-left"></em></a>
                                    <a href="{{ url()->previous() }}"
                                        class="btn py-0 px-1 btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em
                                            class="icon ni ni-arrow-left"></em></a>
                                </div>
                            </div>
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">S.no</span>
                                                </th>
                                                <th class="nk-tb-col"><span class="sub-text">User</span></th>

                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Job Type</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Cafe Bill</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Action</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            @foreach ($users as $user)
                                                <?php $i++; ?>

                                                <tr class="nk-tb-item user_row">
                                                    <td class="nk-tb-col">
                                                        <span>{{ $i }}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <div class="user-card">
                                                            <div class="user-avatar bg-dark d-none d-sm-flex">
                                                                <img src="{{ asset($user->image_url) }}" alt="User"
                                                                    style="width: 100%; height:100%;object-fit: cover;" />

                                                            </div>
                                                            <div class="user-info">
                                                                <span class="tb-lead">{{ $user->name }}<span
                                                                        class="dot dot-success d-md-none ml-1"></span></span>
                                                                <span>{{ $user->email }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-md">
                                                        <span>{{ isset($user->role->title) ? $user->job_type : 'Inhouse' }}</span>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-lg">
                                                        <span>{{ $user->cafe_bill }}</span>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-lg">
                                                        <div class="d-flex">
                                                            <button title="Restore" class="btn p-1 btn-warning restore_user"
                                                                onclick="restore_user(this);" id="{{ $user->id }}"
                                                                value="{{ $user->id }}"><em
                                                                    class="icon ni ni-undo"></em>
                                                                Restore
                                                            </button>
                                                            <button title="Delete Permanently" class="btn p-1 btn-danger"
                                                                onclick="permanetly_delete_user(this);"
                                                                value="{{ $user->id }}"><em
                                                                    class="icon ni ni-trash"></em>
                                                                Delete
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr><!-- .nk-tb-item  -->
                                            @endforeach
                                        </tbody>
                                    </table>
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

        function only_digits() {
            $('#atn_number,#contact,#amount').keypress(function(e) {
                var charCode = (e.which) ? e.which : event.keyCode;
                if (String.fromCharCode(charCode).match(/[^0-9]/g))
                    return false;

            });
        }
        // function get_report() {
        //     let form = document.getElementById('users_report_form');
        //     let data = new FormData(form);
        //     call_ajax_with_functions('', '{{ route('user_report') }}', data);
        // }

        function restore_user(me) {
            let id = me.value;
            let data = new FormData();
            data.append('id', id);
            data.append('_token', "{{ csrf_token() }}");
            swal({
                title: "Are you sure?",
                text: "Do you really want to restore this deleted record?",
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
                    call_ajax('', '{{ route('user_restore') }}', data);
                }
            })
        }

        function permanetly_delete_user(me) {
            let id = me.value;
            let data = new FormData();
            data.append('id', id);
            data.append('_token', "{{ csrf_token() }}");
            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this record permanetly? You will not be able to recover this.",
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
                    call_ajax('', '{{ route('delete_permanently') }}', data);
                }
            })
        }
    </script>
@endsection
