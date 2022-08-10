<form method="post" id="cafe_form" action="javascript:save_item();" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        @if ($item)
            <input type="hidden" value="{{ $item->id }}" name="id">
        @endif
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-label" for="brand_id">Item Brand Name<code>*</code></label>
                <div class="form-control-wrap ">
                    <div class="form-control-select">
                        <select class="form-control" name="brand_id" id="brand_id" required>
                            <option value="" selected disabled>Select Item Brand
                            </option>
                            @foreach ($brands as $brand)
                                <option {{ $item ? ($item->brand_id == $brand->id ? 'selected' : '') : '' }}
                                    value="{{ $brand->id }}">
                                    {{ $brand->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-label" for="item_name">Item Name<code>*</code></label>
                <div class="form-control-wrap">
                    <div class="form-icon form-icon-right">
                        <em class="icon ni ni-edit"></em>
                    </div>
                    <input type="text" class="form-control" id="item_name" name="item_name"
                        value="{{ $item ? $item->item_name : '' }}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-label" for="price">Price<code>*</code></label>
                <div class="form-control-wrap">
                    <div class="form-icon form-icon-right">
                        <em class="icon ni ni-money"></em>
                    </div>
                    <div class="form-icon form-icon-left">
                        <em class="icon ni ni">Rs.</em>
                    </div>
                    <input type="text" class="form-control" id="price" name="price"
                        value="{{ $item ? $item->price : '' }}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label class="form-label" for="size">size<code> *ml</code></label>
                <div class="form-control-wrap">
                    <div class="form-icon form-icon-right">
                        <em class="icon ni ni-line-chart-up"></em>
                    </div>
                    <input type="text" class="form-control" id="size" name="size"
                        value="{{ $item ? $item->size : '' }}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label class="form-label" for="stock">Stock<code>*</code></label>
                <div class="form-control-wrap">
                    <div class="form-icon form-icon-right">
                        <em class="icon ni ni-cart"></em>
                    </div>
                    <input type="text" class="form-control" id="stock" name="stock"
                        value="{{ $item ? $item->stock : '' }}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label class="form-label" for="item_image">Item Image<code>* (Size less than 2Mb)</code></label>
                <div class="form-control-wrap">
                    <div class="custom-file">
                        <input type="file" name="item_image" class="custom-file-input" id="customFile"
                            value="{{ $item ? $item->item_image : 'required' }}" onchange="readURL(this);"
                            accept="image/*">
                        <label class="custom-file-label" for="item_image">Choose
                            image</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <img class="imagePreview" id="imagePreview" src="{{ $item ? asset($item->item_image) : '' }}" alt="Item Image" style="max-width: 100px;" />

        </div>



        <div class="col-12 d-flex" style="justify-content: right">
            <div class="form-group">
                @if (!$item)
                    <button type="reset" class="btn btn-danger">Reset
                    </button>
                @endif
                <button type="submit" class="btn btn-primary">Add Item</button>
            </div>
        </div>
    </div>
</form>
