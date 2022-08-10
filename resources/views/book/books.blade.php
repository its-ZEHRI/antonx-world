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
                                    <h4 class="nk-block-title">Books List</h4>
                                </div>
                                <div class="nk-block-head-content">
                                    <a class="btn btn-success" href="{{ route('show_books_with_review') }}">
                                        <em class="icon ni ni-book-fill"></em>Book NewsFeed</a>
                                    <a class="btn btn-primary" href="javascript:show_form();">
                                        <em class="icon ni ni-plus"></em> Add New Book</a>

                                </div>
                            </div>

                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">S.no</span>
                                                </th>
                                                <th class="nk-tb-col"><span class="sub-text">Book</span></th>

                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Categories</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Book
                                                        Type</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Book
                                                        File</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Book
                                                        Link</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Action</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            @foreach ($books as $book)
                                                <?php $i++; ?>

                                                <tr class="nk-tb-item user_row">
                                                    <td class="nk-tb-col">
                                                        <span>{{ $i }}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <div class="user-card">
                                                            <div class="user-avatar bg-dark d-none d-sm-flex"
                                                                style="border-radius:20%;background:none">
                                                                <img src="{{ asset($book->book_image) }}" alt="User"
                                                                    style="width:100%;height:100%;object-fit:cover;border-radius:20%;" />

                                                            </div>
                                                            <div class="user-info">
                                                                <span class="tb-lead">{{ $book->title }}<span
                                                                        class="dot dot-success d-md-none ml-1"></span></span>
                                                                <span
                                                                    title="{{ $book->summary }}">{{ Str::of($book->summary)->words(4, ' . . . ') }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-md">
                                                        @if ($book->category_book)
                                                            @foreach ($book->category_book as $cat)
                                                                <span class="badge px-1 badge-outline-primary mb-1">
                                                                    {{ $cat->category_list->title }}</span><br>
                                                            @endforeach
                                                        @else
                                                            <span>No Category added</span>
                                                        @endif
                                                    </td>
                                                    <td class="nk-tb-col tb-col-lg">
                                                        <span>{{ $book->book_type }}</span>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-lg">
                                                        <span>
                                                            @if ($book->book_file)
                                                                <a href="{{ $book->book_file }}" target="_blank">
                                                                    download file</a>
                                                            @else
                                                                No file
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-lg">
                                                        <span>
                                                            <a href="{{ $book->book_link }}" target="_blank">
                                                                Click to view </a>
                                                        </span>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-lg text-center">
                                                        <div class="d-flex justify-center">
                                                            <button title="Edit" class="btn p-1 btn-warning edit_book"
                                                                onclick="edit_book(this);" id="{{ $book->id }}"
                                                                value="{{ $book->id }}"><em
                                                                    class="icon ni ni-edit"></em></button>
                                                            <button title="Delete" class="btn p-1 btn-danger"
                                                                onclick="delete_book(this);"
                                                                value="{{ $book->id }}"><em
                                                                    class="icon ni ni-trash"></em></button>
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

        function show_form() {
            let data = new FormData();
            data.append('id', '');
            data.append('_token', '{{ csrf_token() }}');

            function a() {
                modal_size();
                NioApp.BS.init();
                NioApp.Picker.init();
            }

            function b() {
                $('.form-select').select2({
                    dropdownParent: $(".modal-body")
                });
            }
            arr = [a, b];
            call_ajax_modal_with_functions('{{ route('book_form') }}', data, 'Add New Book', arr);
        }

        function save_book() {

            let form = document.getElementById('book_form');
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
            call_ajax_with_functions('', '{{ route('book_save') }}', data, arr);
        }

        function edit_book(me) {
            let id = me.value;
            let data = new FormData();
            data.append('id', id);
            data.append('_token', "{{ csrf_token() }}");

            function a() {
                modal_size();
                NioApp.BS.init();
                NioApp.Picker.init();
            }

            function b() {
                $('.form-select').select2({
                    dropdownParent: $(".modal-body")
                });
            }
            arr = [a, b];
            call_ajax_modal_with_functions('{{ route('book_form') }}', data, 'Edit Book', arr);
        }

        function delete_book(me) {
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
                    call_ajax('', '{{ route('book_delete') }}', data);
                }
            })
        }
    </script>
@endsection
