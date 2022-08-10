<form method="post" id="brand_form" action="javascript:save_brand();" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <div class="col-lg-12">
            @if ($brand)
                <input type="hidden" value="{{ $brand->id }}" name="id">
            @endif
            <div class="form-group">
                <label class="form-label" for="brand_name">Enter Brand Name</label>
                <div class="form-control-wrap">
                    <div class="form-icon form-icon-right">
                        <em class="icon ni ni-user"></em>
                    </div>
                    <input type="text" class="form-control" id="brand_name" name="brand_name"
                        value="{{ $brand ? $brand->brand_name : '' }}" required>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex" style="justify-content: right">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save Brand Name</button>
                </button>
            </div>
        </div>
    </div>
</form>
</form>
