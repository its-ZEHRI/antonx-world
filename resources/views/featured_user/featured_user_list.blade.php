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
                                    <h4 class="nk-block-title">Featured User List</h4>
                                </div>
                                <div class="nk-block-head-content">
                                    <a class="btn btn-primary" href="javascript:show_form();">
                                        <em class="icon ni ni-plus"></em> Add Feature User</a>
                                </div>
                            </div>
                            <table class="datatable-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
                                <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                        <th class="nk-tb-col tb-col-sm"><span>S.No</span></th>
                                        <th class="nk-tb-col tb-col-sm"><span>Badge</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">User</span></th>
                                        <th class="nk-tb-col tb-col-md"><span>Title</span></th>
                                        <th class="nk-tb-col tb-col-md"><span>Description</span></th>
                                        <th class="nk-tb-col tb-col-md"><span>Date</span></th>
                                        <th class="nk-tb-col tb-col-md"><span>Expire Date</span></th>
                                        <th class="nk-tb-col tb-col-md"><span>Action</span></th>
                                    </tr><!-- .nk-tb-item -->
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($featured_users as $feature)
                                        <tr class="nk-tb-item">
                                            <td class="nk-tb-col tb-col-sm">
                                                <span>{{ $i++ }}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-sm">
                                                <div class="user-avatar bg-dark d-none d-sm-flex"
                                                    style="border-radius:25%;">
                                                    <img src="{{ asset($feature->badge_icon) }}" alt="icon"
                                                        style="border-radius:25%;width:100%;height:100%;object-fit: contain;" />
                                                </div>
                                            </td>
                                            <td class="nk-tb-col">
                                                <div class="user-card">
                                                    <div class="user-avatar bg-dark d-none d-sm-flex">
                                                        <img src="{{ asset($feature->user->image_url) }}" alt="User"
                                                            style="border-radius:25%;width:100%;height:100%;object-fit: cover;" />
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="tb-lead">{{ $feature->user->name }}<span
                                                                class="dot dot-success d-md-none ml-1"></span></span>
                                                        <span>{{ $feature->user->email }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="nk-tb-col">
                                                <span title="{{ $feature->title }}"
                                                    class="tb-lead">{{ Str::of($feature->title)->words(3, ' . . . ') }}</span>
                                            </td>
                                            <td class="nk-tb-col">
                                                <span title="{{ $feature->description }}"
                                                    class="tb-lead">{{ Str::of($feature->description)->words(5, ' . . . ') }}</span>
                                            </td>

                                            <td class="nk-tb-col">
                                                <span class="tb-lead">{{ date('F Y', strtotime($feature->date)) }}</span>
                                            </td>
                                            <td class="nk-tb-col">
                                                <span class="tb-lead">{{ date_with_slash($feature->expire_date) }}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-md">
                                                <a href="{{ url('user_view/' . $feature->user_id) }}"
                                                    class="btn p-1 btn-primary">
                                                    <em class="icon ni ni-eye"></em>
                                                </a>
                                                <button title="Edit" class="btn p-1 btn-warning edit_attend"
                                                    onclick="edit_feature(this);" id="{{ $feature->id }}"
                                                    value="{{ $feature->id }}"><em class="icon ni ni-edit"></em></button>
                                                <button title="Delete" class="btn p-1 btn-danger"
                                                    onclick="delete_feature(this);" value="{{ $feature->id }}"><em
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

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imagePreview')
                        .attr('src', e.target.result);
                    $('#imagePreview').removeClass('d-none');
                    $('#imagePreview').addClass('d-flex');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function show_form() {
            let data = new FormData();
            data.append('id', '');
            data.append('_token', '{{ csrf_token() }}');

            function a() {
                modal_size();
                $('.form-select').select2({
                    dropdownParent: $(".modal-body")
                });
                NioApp.BS.init();
                NioApp.Picker.init();

            }
            arr = [a];
            call_ajax_modal_with_functions('{{ route('feature_user_form') }}', data, 'Add Featured User', arr);

        }

        function save_feature_user() {
            let form = document.getElementById('feature_user_form');
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
            call_ajax_with_functions('', '{{ route('feature_user_save') }}', data, arr);
        }

        function edit_feature(me) {
            let id = me.value;
            let data = new FormData();
            data.append('id', id);
            data.append('_token', "{{ csrf_token() }}");

            function a() {
                modal_size();
                $('.form-select').select2({
                    dropdownParent: $(".modal-body")
                });
                NioApp.BS.init();
                NioApp.Picker.init();

            }
            arr = [a];
            call_ajax_modal_with_functions('{{ route('feature_user_form') }}', data, 'Edit Featured User', arr);
        }

        function delete_feature(me) {
            let id = me.value;
            let data = new FormData();
            data.append('id', id);
            data.append('_token', "{{ csrf_token() }}");
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
                    call_ajax('', '{{ route('feature_user_delete') }}', data);
                }
            })
        }
    </script>
@endsection
