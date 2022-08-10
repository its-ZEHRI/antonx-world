<form method="post" id="userCompany_form" action="javascript:userCompany_save();" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        @if ($userCompany)
            <input type="hidden" value="{{ $userCompany->id }}" name="id">
            <input type="hidden" value="{{ $userCompany->user_id }}" name="user_id">
            {{-- <span>{{$userCompany->user->name}}</span> --}}
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label" for="">User Name</label>
                    <div class="form-control-wrap">
                        <div class="form-icon form-icon-right">
                            <em class="icon ni ni-user"></em>
                        </div>
                        <input type="text" readonly class="form-control" id="user_name" name="user_name"
                            value="{{ $userCompany ? $userCompany->user->name : '' }}" required>
                    </div>
                </div>
            </div>
        @else
            <input type="hidden" value="{{ $user->id }}" name="user_id">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label" for="">User Name</label>
                    <div class="form-control-wrap">
                        <div class="form-icon form-icon-right">
                            <em class="icon ni ni-user"></em>
                        </div>
                        <input type="text" readonly class="form-control" id="user_name" name="user_name"
                            value="{{ $user ? $user->name : '' }}" required>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="designation">Designation<code>*</code></label>
                <div class="form-control-wrap ">
                    <div class="form-control-select">
                        <select class="form-control" name="designation" id="designation" required>
                            <option class="form-control" value="" selected disabled>
                                Select Designation</option>
                            @foreach ($designations as $desig)
                                <option
                                    {{ $userCompany ? ($userCompany->designation == $desig->title ? 'selected' : '') : '' }}
                                    value="{{ $desig->id }}">
                                    {{ $desig->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="form-group">
                <label class="form-label" for="startDate">Start Date<code>*</code></label>
                <div class="form-control-wrap">
                    <div class="form-icon form-icon-right">
                        <em class="icon ni ni-user"></em>
                    </div>
                    <input type="date" class="form-control" id="startDate" name="startDate"
                        value="{{ $userCompany ? $userCompany->startDate : '' }}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-label" for="endDate">End Date<code> if applicable</code></label>
                <div class="form-control-wrap">
                    <div class="form-icon form-icon-right">
                        <em class="icon ni ni-user"></em>
                    </div>
                    <input type="date" class="form-control" id="endDate" name="endDate"
                        value="{{ $userCompany ? $userCompany->endDate : '' }}">
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label class="form-label" for="currently_working">Currently working</label>
                <div class="custom-control custom-control-lg custom-checkbox">
                    <input type="checkbox" name="currently_working" class="custom-control-input" id="customCheck2">
                    <label class="custom-control-label" for="customCheck2">Present</label>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex" style="justify-content: right">
            <div class="form-group">
                <button type="reset" class="btn btn-danger">Reset
                </button>
                <button type="submit" class="btn btn-primary">Save Company Info</button>
            </div>
        </div>
    </div>
</form>
</form>
