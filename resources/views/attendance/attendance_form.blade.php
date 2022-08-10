<form method="post" id="attendance_form" action="javascript:save_attendance();" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <div class="col-lg-6">
            @if ($attendance)
                <input type="hidden" value="{{ $attendance->id }}" name="id">
            @endif
            <div class="form-group">
                <label class="form-label" for="date">Select Date</label>
                <div class="form-control-wrap">
                    <input type="Date" class="form-control" id="date" name="date"
                        value="{{ $attendance ? $attendance->date : '' }}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="user_id">Select User</label>
                <div class="form-control-wrap ">
                    <div class="form-control-select">
                        <select class="form-control" name="user_id" id="user_id" required>
                            <option class="form-control" value="" selected disabled>
                                Select User</option>
                            @foreach ($users as $user)
                                <option {{ $attendance ? ($attendance->user_id == $user->id ? 'selected' : '') : '' }}
                                    value="{{ $user->id }}">
                                    {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="check_in_time">Check In Time</label>
                <div class="form-control-wrap">
                    <input type="time" name="check_in_time" class="form-control" id="check_in_time"
                        value="{{ $attendance ? $attendance->check_in_time : '' }}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="check_out_time">Check Out Time</label>
                <div class="form-control-wrap">
                    <input type="time" name="check_out_time" class="form-control" id="check_out_time"
                        value="{{ $attendance ? $attendance->check_out_time : '' }}">
                </div>
            </div>
        </div>
        <div class="col-12 d-flex" style="justify-content: right">
            <div class="form-group">
                <button type="reset" class="btn btn-danger">Reset
                </button>
                <button type="submit" class="btn btn-primary">Save attendance</button>
            </div>
        </div>
    </div>
</form>
