<form method="post" id="role_form" action="javascript:save_role();" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <div class="col-lg-12">
            @if ($role)
                <input type="hidden" value="{{ $role->id }}" name="id">
            @endif
            <div class="form-group">
                <label class="form-label" for="title">Enter Role Title</label>
                <div class="form-control-wrap">
                    <div class="form-icon form-icon-right">
                        <em class="icon ni ni-user"></em>
                    </div>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ $role ? $role->title : '' }}" required>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex" style="justify-content: right">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save Role</button>
                <button type="reset" class="btn btn-danger">Reset
                </button>
            </div>
        </div>
    </div>
</form>
</form>
