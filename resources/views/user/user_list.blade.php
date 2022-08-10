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
                                    <h4 class="nk-block-title">User List</h4>
                                </div>
                                <div class="nk-block-head-content">
                                    <a class="btn btn-danger" href="{{ route('deleted_users') }}">Disabled Users</a>
                                    <a class="btn btn-primary" href="{{ route('user_form') }}">
                                        <em class="icon ni ni-plus"></em> Add New User</a>
                                    {{-- <a class="btn btn-primary" href="javascript:show_form();">
                                        <em class="icon ni ni-plus"></em> Add New User</a> --}}

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
                                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Phone</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Job Type</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Role</span>
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
                                                        <span>{{ $user->contact }}</span>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-md">
                                                        <span>{{ isset($user->role->title) ? $user->job_type : 'Inhouse' }}</span>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-md">
                                                        <span>{{ isset($user->role->title) ? $user->role->title : 'No Role' }}</span>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-lg">
                                                        <span>{{ $user->cafe_bill }}</span>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-lg text-center">
                                                        <div class="d-flex justify-center">
                                                            @if ($user->id == 1)
                                                                <button title="Change Password" class="btn p-1 btn-info"
                                                                    onclick="update_user_password(this);"
                                                                    value="{{ $user->id }}"><em
                                                                        class="icon ni ni-unlock"></em>
                                                                </button>
                                                                <button title="Edit" class="btn p-1 btn-warning edit_user"
                                                                    onclick="edit_user(this);" id="{{ $user->id }}"
                                                                    value="{{ $user->id }}"><em
                                                                        class="icon ni ni-edit"></em></button>
                                                                <button title="Delete" class="btn p-1 btn-danger"
                                                                    onclick="delete_user(this);"
                                                                    value="{{ $user->id }}"><em
                                                                        class="icon ni ni-trash"></em></button>
                                                            @else
                                                                <button title="Pay user Bill" class="btn  p-1 btn-success"
                                                                    onclick="pay_bill_form(this);"
                                                                    value="{{ $user->id }}">
                                                                    <em class="icon ni ni-money"></em>
                                                                </button>
                                                                <a title="View"
                                                                    href="{{ url('user_view/' . $user->id) }}"
                                                                    class="btn p-1 btn-primary">
                                                                    <em class="icon ni ni-eye"></em>
                                                                </a>
                                                                <button title="Change Password" class="btn p-1 btn-info"
                                                                    onclick="update_user_password(this);"
                                                                    value="{{ $user->id }}"><em
                                                                        class="icon ni ni-unlock"></em>
                                                                </button>
                                                                <a title="Edit"
                                                                    href="{{ url('user_edit_form/' . $user->id) }}"
                                                                    class="btn p-1 btn-warning edit_user">
                                                                    <em class="icon ni ni-edit"></em>
                                                                </a>
                                                                <button title="Delete" class="btn p-1 btn-danger"
                                                                    onclick="delete_user(this);"
                                                                    value="{{ $user->id }}"><em
                                                                        class="icon ni ni-trash"></em></button>
                                                            @endif
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

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#UserimagePreview')
                        .attr('src', e.target.result);
                    $('#UserimagePreview').removeClass('d-none');
                    $('#UserimagePreview').addClass('d-flex');
                };

                reader.readAsDataURL(input.files[0]);
            }
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

        function update_user_password(me) {
            let id = me.value;
            let data = new FormData();
            data.append('id', id);
            data.append('_token', "{{ csrf_token() }}");

            function a() {
                only_digits()
                NioApp.Passcode('.passcode-switch');
                NioApp.BS.init();
                NioApp.Picker.init();
                $('#atn_number,#password').attr('autocomplete', 'off');
            }
            arr = [a];
            call_ajax_modal_with_functions('{{ route('user_password_form') }}', data, 'Change User Password', arr);
        }

        function save_password() {

            let form = document.getElementById('user_password_form');
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
            call_ajax_with_functions('', '{{ route('change_password') }}', data, arr);
        }
    </script>
@endsection
