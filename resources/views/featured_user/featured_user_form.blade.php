<style>
    .imagePreview {
        max-width: 200px;
    }
</style>
<form method="post" id="feature_user_form" action="javascript:save_feature_user();" enctype="multipart/form-data"
    runat="server">
    @csrf
    <div class="row g-4">
        <div class="col-lg-4">
            @if ($featured_user)
                <input type="hidden" value="{{ $featured_user->id }}" name="id">
            @endif
            <div class="form-group">
                <div class="form-group">
                    <label class="form-label">Select User<code>*</code></label>
                    <div class="form-control-wrap">
                        <select class="form-select" id="form-select" name="user_id" data-placeholder="select user">
                            <option selected disabled value="">Select User</option>
                            @foreach ($users as $user)
                                <option
                                    {{ $featured_user ? ($featured_user->user_id == $user->id ? 'selected' : '') : '' }}
                                    value="{{ $user->id }}">
                                    {{ $user->name }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-label" for="title">Featured Title<code>*</code></label>
                <div class="form-control-wrap">
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ $featured_user ? $featured_user->title : '' }}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-label" for="feature_date">Featured Date<code>*</code></label>
                <div class="form-control-wrap">
                    <input type="date" name="feature_date" class="form-control" id="feature_date"
                        value="{{ $featured_user ? $featured_user->date : '' }}">
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-label" for="feature_expire_date">Featured Expire Date<code>*</code></label>
                <div class="form-control-wrap">
                    <input type="date" name="feature_expire_date" class="form-control" id="feature_expire_date"
                        value="{{ $featured_user ? $featured_user->expire_date : '' }}">
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-label" for="badge_icon">Featured Badge Icon<code>* (Size less than 2Mb)</code></label>
                <div class="form-control-wrap">
                    <div class="custom-file">
                        <input type="file" name="badge_icon" class="custom-file-input" id="customFile"
                            value="{{ $featured_user ? $featured_user->badge_icon : 'required' }}"
                            onchange="readURL(this);" accept="image/*">
                        <label class="custom-file-label" for="badge_icon">Choose Icon</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <img class="imagePreview" id="imagePreview" src="{{  $featured_user ? asset($featured_user->badge_icon) : '' }}" alt="your image" style="max-width: 100px;" />

        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label" for="cf-default-textarea">Featured Description<code>*</code></label>
                <div class="form-control-wrap">
                    <textarea class="form-control form-control-sm" id="description" name="description"
                        value="{{ $featured_user ? $featured_user->description : '' }}" required>{{ $featured_user ? $featured_user->description : '' }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex" style="justify-content: right">
            <div class="form-group">
                <button type="reset" class="btn btn-danger">Reset
                </button>
                <button type="submit" class="btn btn-primary">Save Feature</button>
            </div>
        </div>
    </div>
</form>
<script>
    customFile.onchange = evt => {
        const [file] = customFile.files
        if (file) {
            badge.src = URL.createObjectURL(file)
        }
    }
</script>
