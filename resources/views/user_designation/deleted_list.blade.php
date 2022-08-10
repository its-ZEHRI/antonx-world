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
                                    <h4 class="nk-block-title">User Designations List</h4>
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
                                            <?php $i = 0; ?>
                                            @foreach ($designations as $desig)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $desig->title }}</td>
                                                    <td>{{ $desig->slug }}</td>
                                                    <td>{{ isset($desig->createdBy->name) ? $desig->createdBy->name : '' }}
                                                    </td>
                                                    <td>{{ parse_datetime_get($desig->created_at) }} </td>
                                                    <td>
                                                        <button title="Undo" class="btn p-1 btn-warning edit_designation"
                                                            onclick="undo_designation(this);" id="{{ $desig->id }}"
                                                            value="{{ $desig->id }}"><em
                                                                class="icon ni ni-undo"></em></button>
                                                        <button title="Delete" class="btn p-1 btn-danger"
                                                            onclick="delete_designation(this);"
                                                            value="{{ $desig->id }}"><em
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
        function undo_designation(me) {
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
                    call_ajax('', '{{ route('designation_delete_undo') }}', data);
                }
            })
        }

        function delete_designation(me) {
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
                    call_ajax('', '{{ route('designation_delete_permanently') }}', data);
                }
            })
        }
    </script>
@endsection
