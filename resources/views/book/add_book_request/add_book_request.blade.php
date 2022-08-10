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
                                    <h4 class="nk-block-title">Add Book to Library Requests</h4>
                                </div>
                              
                            </div>
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init table">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Title</th>
                                                <th>Request by</th>
                                                <th>Added On</th>
                                                <th>Remarks</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($add_book_requests as $req)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $req->book_title }}</td>
                                                    
                                                    <td>{{ isset($req->user->name) ? $req->user->name : '' }}
                                                    </td>
                                                    <td>{{ parse_datetime_get($req->created_at) }} </td>
                                                    <td title="{{ $req->remarks }}">
                                                        {{ Str::of($req->remarks)->words(5, ' . . . ') }}
                                                    </td>
                                                    <td>
                                                        @if ($req->request_status == 'pending')
                                                            <span class="dot bg-danger d-mb-none"></span>
                                                            <span
                                                                class="badge badge-sm badge-dot has-bg badge-danger d-none d-mb-inline-flex">
                                                                {{ $req->request_status }}</span>
                                                        @elseif($req->request_status == 'accepted')
                                                            <span class="dot bg-success d-mb-none"></span>
                                                            <span
                                                                class="badge badge-sm badge-dot has-bg badge-success d-none d-mb-inline-flex">
                                                                {{ $req->request_status }}</span>
                                                        @elseif($req->request_status == 'rejected')
                                                            <span class="dot bg-secandry d-mb-none"></span>
                                                            <span
                                                                class="badge badge-sm badge-dot has-bg badge-secandry d-none d-mb-inline-flex"
                                                                style="text-decoration: line-through;">
                                                                {{ $req->request_status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button title="Edit" class="btn p-1 btn-warning edit_book_request"
                                                            onclick="edit_book_request(this);" id="{{ $req->id }}"
                                                            value="{{ $req->id }}"><em
                                                                class="icon ni ni-edit"></em></button>
                                                        <button title="Delete" class="btn p-1 btn-danger"
                                                            onclick="delete_book_request(this);"
                                                            value="{{ $req->id }}"><em
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
            $('.modal-dialog').addClass('modal-xl');
        }

        function add_request_remark() {
            let form = document.getElementById('request_remark_form');
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
            call_ajax_with_functions('', '{{ route('save_request_remark') }}', data, arr);
        }

        function edit_book_request(me) {
            let id = me.value;
            let data = new FormData();
            data.append('id', id);
            data.append('_token', "{{ csrf_token() }}");

            function a() {
                modal_size();
            }
            arr = [a];
            call_ajax_modal_with_functions('{{ route('book_request_form') }}', data, 'Add Remark to This Request ', arr);
        }

        function delete_book_request(me) {
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
                    call_ajax('', '{{ route('book_request_delete') }}', data);
                }
            })
        }
    </script>
@endsection
