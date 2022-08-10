<form method="post" id="book_form" action="javascript:save_book();" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        @if ($book)
            <input type="hidden" value="{{ $book->id }}" name="id">
        @endif
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="title">Book Title<code>*</code></label>
                <div class="form-control-wrap">
                    <div class="form-icon form-icon-right">
                        <em class="icon ni ni-book-fill"></em>
                    </div>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ $book ? $book->title : '' }}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="author">Book Author<code>*</code></label>
                <div class="form-control-wrap">
                    <div class="form-icon form-icon-right">
                        <em class="icon ni ni-pen"></em>
                    </div>
                    <input type="text" class="form-control" id="author" name="author"
                        value="{{ $book ? $book->author : '' }}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-label" for="book_type">Book Type<code>*</code></label>
                <div class="form-control-wrap ">
                    <div class="form-control-select">
                        <select class="form-control" name="book_type" id="book_type" required>
                            <option value="" selected disabled>Select Book Type
                            </option>
                            <option {{ $book ? ($book->book_type == 'hard copy' ? 'selected' : '') : '' }}
                                value="hard copy">
                                Hard Copy</option>
                            <option {{ $book ? ($book->book_type == 'soft copy' ? 'selected' : '') : '' }}
                                value="soft copy">
                                Soft Copy</option>
                            <option {{ $book ? ($book->book_type == 'both' ? 'selected' : '') : '' }} value="both">
                                Both
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-label" for="book_image">Cover Image<code>* (Size upto 2Mb)</code></label>
                <div class="form-control-wrap">
                    <div class="custom-file">
                        <input type="file" name="book_image" class="custom-file-input" id="customFile"
                            value="{{ $book ? $book->book_image : 'required' }}">
                        <label class="custom-file-label" for="book_image">Choose
                            image</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-label" for="book_file">Upload Book<code>(file if available)</code></label>
                <div class="form-control-wrap">
                    <div class="custom-file">
                        <input type="file" name="book_file" class="custom-file-input" id="book_file"
                            value="{{ $book ? $book->book_file : 'required' }}">
                        <label class="custom-file-label" for="book_file">Choose
                            file</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="form-group">
                <label class="form-label">Select Category<code>*</code></label>
                <div class="form-control-wrap">
                    <select class="form-select" id="form-select" name="category[][id]" multiple="multiple"
                        data-placeholder="select multiple options">

                        @if ($book)
                            @foreach ($book->category_book as $cat)
                                <option {{ $book ? ($book->id == $cat->book_id ? 'selected' : '') : '' }}
                                    value="{{ $cat->category_list->id }}">
                                    {{ $cat->category_list->title }}</option>
                            @endforeach
                        @endif
                        @foreach ($category_list as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->title }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-label" for="book_link">Book Link<code>(Downloadable link)</code></label>
                <div class="form-control-wrap">
                    <div class="form-icon form-icon-right">
                        <em class="icon ni ni-link"></em>
                    </div>
                    <input type="text" name="book_link" class="form-control" id="book_link"
                        value="{{ $book ? $book->book_link : '' }}">
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label" for="cf-default-textarea">Summary<code>* upto 150 words</code></label>
                <div class="form-control-wrap">
                    <textarea class="form-control form-control-sm" id="summary" name="summary" style="min-height: 60px;"
                        value="{{ $book ? $book->summary : '' }}">{{ $book ? $book->summary : '' }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex" style="justify-content: right">
            <div class="form-group">
                @if (!$book)
                    <button type="reset" class="btn btn-danger">Reset
                    </button>
                @endif
                <button type="submit" class="btn btn-primary">Save Book</button>
            </div>
        </div>
    </div>
</form>
