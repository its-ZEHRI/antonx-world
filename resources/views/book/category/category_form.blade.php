<form method="post" id="book_category_form" action="javascript:save_category();" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <div class="col-lg-12">
            @if ($category)
                <input type="hidden" value="{{ $category->id }}" name="id">
            @endif
            <div class="form-group">
                <label class="form-label" for="title">Enter Category Title<code>*</code></label>
                <div class="form-control-wrap">
                    <div class="form-icon form-icon-right">
                        <em class="icon ni ni-book-fill"></em>
                    </div>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ $category ? $category->title : '' }}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label" for="cf-default-textarea">Category Description<code>*</code></label>
                <div class="form-control-wrap">
                    <textarea class="form-control form-control-sm" id="description" name="description"
                        value="{{ $category ? $category->description : '' }}" required>{{ $category ? $category->description : '' }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex" style="justify-content: right">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save Category</button>
                <button type="reset" class="btn btn-danger">Reset
                </button>
            </div>
        </div>
    </div>
</form>
</form>
