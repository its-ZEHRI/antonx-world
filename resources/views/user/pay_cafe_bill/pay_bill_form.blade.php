<form method="post" id="cafe_bill_form" action="javascript:update_cafe_bill();" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        @if ($user)
            <input type="hidden" value="{{ $user->id }}" name="id">
        @endif
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="full_name">Full Name</label>
                <div class="form-control-wrap">
                    <div class="form-icon form-icon-right">
                        <em class="icon ni ni-user"></em>
                    </div>
                    <input type="text" class="form-control" id="full_name" name="full_name"
                        value="{{ $user ? $user->name : '' }}" readonly>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="cafe_bill">Total Cafe Bill</label>
                <div class="form-control-wrap">
                    <div class="form-icon form-icon-right">
                        <em class="icon ni ni-user"></em>
                    </div>
                    <div class="form-icon form-icon-left">
                        <span class="pl-2">Rs.</span>
                    </div>
                    <input type="number" class="form-control" id="cafe_bill" name="cafe_bill"
                        value="{{ $user ? $user->cafe_bill : '' }}" readonly>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label" for="amount">Enter Received Amount<code>*</code></label>
                <div class="form-control-wrap">
                    <div class="form-icon form-icon-right">
                        <em class="icon ni ni-money"></em>
                    </div>
                    <input type="number" name="amount" class="form-control" id="amount" required>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex" style="justify-content: right">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Pay Bill</button>
            </div>
        </div>
    </div>
</form>
