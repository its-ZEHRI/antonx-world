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
                                    <h4 class="nk-block-title">Cafe Item Brand List</h4>
                                </div>
                                <div class="nk-block-head-content">
                                    <a class="btn btn-primary" href="javascript:show_form();">
                                        <em class="icon ni ni-plus"></em> Add New Brand Name</a>
                                </div>
                            </div>
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init table">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Title</th>
                                                <th>Slug</th>
                                                <th>Added by</th>
                                                <th>Added On</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($brand_list as $brand)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $brand->brand_name }}</td>
                                                    <td>{{ $brand->slug }}</td>
                                                    <td>{{ isset($brand->createdBy->name) ? $brand->createdBy->name : '' }}
                                                    </td>
                                                    <td>{{ parse_datetime_get($brand->created_at) }} </td>
                                                    <td>
                                                        <button title="Edit" class="btn p-1 btn-warning edit_brand"
                                                            onclick="edit_brand(this);" id="{{ $brand->id }}"
                                                            value="{{ $brand->id }}"><em
                                                                class="icon ni ni-edit"></em></button>
                                                        <button title="Delete" class="btn p-1 btn-danger"
                                                            onclick="delete_brand(this);" value="{{ $brand->id }}"><em
                                                                class="icon ni ni-trash"></em></button>
                                                    </td>
                                                </tr>
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
            $('.modal-dialog').addClass('modal-md');
        }

        function show_form() {
            let data = new FormData();
            data.append('id', '');
            data.append('_token', '{{ csrf_token() }}');

            function a() {
                modal_size();
            }
            arr = [a];
            call_ajax_modal_with_functions('{{ route('brand_form') }}', data, 'Add User Brand', arr);
        }

        function save_brand() {
            let form = document.getElementById('brand_form');
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
            call_ajax_with_functions('', '{{ route('brand_save') }}', data, arr);
        }

        function edit_brand(me) {
            let id = me.value;
            let data = new FormData();
            data.append('id', id);
            data.append('_token', "{{ csrf_token() }}");

            function a() {
                modal_size();
            }
            arr = [a];
            call_ajax_modal_with_functions('{{ route('brand_form') }}', data, 'Edit Brand', arr);
        }

        function delete_brand(me) {
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
                    call_ajax('', '{{ route('role_delete') }}', data);
                }
            })
        }
    </script>
@endsection
