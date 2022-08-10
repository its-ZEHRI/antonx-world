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
                                    <h4 class="nk-block-title">Cafe Item List</h4>
                                </div>
                                <div class="nk-block-head-content">
                                    <a class="btn btn-primary" href="javascript:show_form();">
                                        <em class="icon ni ni-plus"></em> Add Cafe Item</a>
                                </div>
                            </div>

                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">S.no</span>
                                                </th>
                                                <th class="nk-tb-col"><span class="sub-text">Item</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Brand Name</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">price/<code>per
                                                            item</code></span>
                                                </th>
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Stock</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Action</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            @foreach ($cafe_items as $item)
                                                <?php $i++; ?>

                                                <tr class="nk-tb-item user_row">
                                                    <td class="nk-tb-col">
                                                        <span>{{ $i }}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <div class="user-card">
                                                            <div class="user-avatar bg-dark d-none d-sm-flex"
                                                                style="background:none">
                                                                <img src="{{ asset($item->item_image) }}" alt="item Image"
                                                                    style="width:100%;height:100%;object-fit:cover;" />

                                                            </div>
                                                            <div class="user-info">
                                                                <span class="tb-lead">{{ $item->item_name ? $item->item_name : 'Item Name' }}<span
                                                                        class="dot dot-success d-md-none ml-1"></span></span>
                                                                <span>{{ $item->size }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-lg">
                                                        <span class="text-primary">{{ $item->brand->brand_name }}</span></span>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-lg">
                                                        <span><b>Rs.</b> <span
                                                                class="text-primary">{{ $item->price }}</span></span>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-lg">
                                                        <span>{{ $item->stock }}</span>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-lg text-center">
                                                        <div class="d-flex justify-center">
                                                            {{-- <a href="{{ url('view_item/' . $item->id) }}"
                                                                class="btn p-1 btn-primary">
                                                                <em class="icon ni ni-eye"></em>
                                                            </a> --}}
                                                            <button title="Edit" class="btn p-1 btn-warning edit_item"
                                                                onclick="edit_item(this);" id="{{ $item->id }}"
                                                                value="{{ $item->id }}"><em
                                                                    class="icon ni ni-edit"></em></button>
                                                            <button title="Delete" class="btn p-1 btn-danger"
                                                                onclick="delete_item(this);" value="{{ $item->id }}"><em
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

        function only_digits() {
            $('#price,#stock').keypress(function(e) {
                var charCode = (e.which) ? e.which : event.keyCode;
                if (String.fromCharCode(charCode).match(/[^0-9]/g))
                    return false;

            });
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
                only_digits();
                NioApp.BS.init();
                NioApp.Picker.init();
            }
            arr = [a];
            call_ajax_modal_with_functions('{{ route('cafe_item_form') }}', data, 'Add Cafe Item', arr);
        }

        function save_item() {
            let form = document.getElementById('cafe_form');
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
            call_ajax_with_functions('', '{{ route('cafe_item_save') }}', data, arr);
        }

        function edit_item(me) {
            let id = me.value;
            let data = new FormData();
            data.append('id', id);
            data.append('_token', "{{ csrf_token() }}");

            function a() {
                modal_size();
                only_digits();
                NioApp.BS.init();
                NioApp.Picker.init();
            }
            arr = [a];
            call_ajax_modal_with_functions('{{ route('cafe_item_form') }}', data, 'Edit cafe Item', arr);
        }

        function delete_item(me) {
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
                    call_ajax('', '{{ route('cafe_item_delete') }}', data);
                }
            })
        }
    </script>
@endsection
