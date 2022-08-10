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
                                    <h4 class="nk-block-title">Book Categories</h4>
                                </div>
                                <div class="nk-block-head-content">
                                    <a class="btn btn-primary" href="javascript:show_form();">
                                        <em class="icon ni ni-plus"></em>Add Book Category</a>
                                </div>
                            </div>
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init table">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Added by</th>
                                                <th>Added On</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($book_categories as $cate)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $cate->title }}</td>
                                                    <td title="{{ $cate->description }}">
                                                        {{ Str::of($cate->description)->words(7, ' . . . ') }}</td>
                                                    <td>{{ isset($cate->creator->name) ? $cate->creator->name : '' }}
                                                    </td>
                                                    <td>{{ parse_datetime_get($cate->created_at) }} </td>
                                                    <td>
                                                        <button title="Edit" class="btn p-1 btn-warning edit_category"
                                                            onclick="edit_category(this);" id="{{ $cate->id }}"
                                                            value="{{ $cate->id }}"><em
                                                                class="icon ni ni-edit"></em></button>
                                                        <button title="Delete" class="btn p-1 btn-danger"
                                                            onclick="delete_category(this);" value="{{ $cate->id }}"><em
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
            call_ajax_modal_with_functions('{{ route('book_category_form') }}', data, 'Add Book Category', arr);
        }

        function save_category() {
            let form = document.getElementById('book_category_form');
            let data = new FormData(form);
            let a = function() {
                $('#background_fade_form').fadeOut(function() {
                    $(this).remove();
                });
                window.location.reload();
            }
            let b = function() {
                window.location.reload();
            }
            let arr = [a, b];
            call_ajax_with_functions('', '{{ route('book_category_save') }}', data, arr);
        }

        function edit_category(me) {
            let id = me.value;
            let data = new FormData();
            data.append('id', id);
            data.append('_token', "{{ csrf_token() }}");

            function a() {
                modal_size();
            }
            arr = [a];
            call_ajax_modal_with_functions('{{ route('book_category_form') }}', data, 'Edit Book Category', arr);
        }

        function delete_category(me) {
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
                    call_ajax('', '{{ route('book_category_delete') }}', data);
                }
            })
        }
    </script>
@endsection
