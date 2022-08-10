<form method="post" id="user_password_form" action="javascript:save_password();" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <div class="col-lg-12">
            @if ($user)
                <input type="hidden" value="{{ $user->id }}" name="id">
            @endif
            <div class="form-group">
                <label class="form-label" for="password">Password<code>*</code></label>
                <div class="form-control-wrap">
                    <a href="javascript:void(0);" class="form-icon form-icon-right passcode-switch"
                        data-target="password">
                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                    </a>
                    <input type="password" name="password" class="form-control" id="password" value="" required>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex" style="justify-content: right">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">update user password</button>

            </div>
        </div>
    </div>
</form>
</form>
