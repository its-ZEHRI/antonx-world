@extends('layouts.app')
@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview ">
                        <div class="nk-block nk-block-lg">
                            <div class="nk-block-between mb-4">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">Add new User Form</h4>
                                </div>
                                <div class="nk-block-head-content">
                                    <a class="btn btn-primary" href="{{ route('user') }}">Users List</a>
                                    <a href="{{ url()->previous() }}"
                                        class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em
                                            class="icon ni ni-arrow-left"></em>Back</a>
                                    <a href="{{ url()->previous() }}"
                                        class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em
                                            class="icon ni ni-arrow-left"></em></a>


                                </div>
                            </div>

                            <div class="card card-preview">
                                <div class="card-inner">
                                    <form method="post" id="user_form" action="javascript:save_user();"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-4">
                                            @if ($user)
                                                <input type="hidden" value="{{ $user->id }}" name="id">
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="form-label" for="atn_number">User ATN
                                                            Number<code>*</code></label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <span class="pl-2">ATN-</span>
                                                            </div>
                                                            <input type="text" class="form-control" id="atn_number"
                                                                name="atn_number"
                                                                value="{{ $user ? $user->atn_number : '' }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="form-label" for="atn_number">User ATN
                                                            Number<code>*</code></label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <span class="pl-2">ATN-</span>
                                                            </div>
                                                            <input type="text" class="form-control" id="atn_number"
                                                                name="atn_number"
                                                                value="{{ $user ? $user->atn_number : '' }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="full_name">Full
                                                        Name<code>*</code></label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-right">
                                                            <em class="icon ni ni-user"></em>
                                                        </div>
                                                        <input type="text" class="form-control" id="full_name"
                                                            name="full_name" value="{{ $user ? $user->name : '' }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="role_id">Role<code>*</code></label>
                                                    <div class="form-control-wrap ">
                                                        <div class="form-control-select">
                                                            <select class="form-control" name="role_id" id="role_id"
                                                                required>
                                                                <option class="form-control" value="" selected
                                                                    disabled>
                                                                    Select Role</option>
                                                                @if ($user)
                                                                    @if (Auth::user()->role->slug == 'super-admin')
                                                                        @foreach ($user_roles as $user_role)
                                                                            @if ($user->role->slug == 'super-admin')
                                                                                <option
                                                                                    {{ $user ? ($user->role_id == $user_role->id ? 'selected' : '') : '' }}
                                                                                    value="{{ $user_role->id }}">
                                                                                    {{ $user_role->title }}</option>
                                                                            @else
                                                                                @if ($user_role->slug == 'super-admin')
                                                                                    <option disabled>No Role </option>
                                                                                @else
                                                                                    <option
                                                                                        {{ $user ? ($user->role_id == $user_role->id ? 'selected' : '') : '' }}
                                                                                        value="{{ $user_role->id }}">
                                                                                        {{ $user_role->title }}</option>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        @foreach ($user_roles as $user_role)
                                                                            @if ($user_role->slug == 'super-admin' || $user_role->slug == 'admin')
                                                                                <option disabled>No Role </option>
                                                                            @else
                                                                                <option
                                                                                    {{ $user ? ($user->role_id == $user_role->id ? 'selected' : '') : '' }}
                                                                                    value="{{ $user_role->id }}">
                                                                                    {{ $user_role->title }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @else
                                                                    @if (Auth::user()->role->slug == 'super-admin')
                                                                        @foreach ($user_roles as $user_role)
                                                                            @if ($user_role->slug == 'super-admin')
                                                                                <option disabled>No Role </option>
                                                                            @else
                                                                                <option
                                                                                    {{ $user ? ($user->role_id == $user_role->id ? 'selected' : '') : '' }}
                                                                                    value="{{ $user_role->id }}">
                                                                                    {{ $user_role->title }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        @foreach ($user_roles as $user_role)
                                                                            @if ($user_role->slug == 'super-admin' || $user_role->slug == 'admin')
                                                                                <option disabled>No Role </option>
                                                                            @else
                                                                                <option
                                                                                    {{ $user ? ($user->role_id == $user_role->id ? 'selected' : '') : '' }}
                                                                                    value="{{ $user_role->id }}">
                                                                                    {{ $user_role->title }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="joining_date">Joining
                                                        Date<code>*</code></label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-right">
                                                            <em class="icon ni ni-calendar-alt"></em>
                                                        </div>
                                                        <input type="text" name="joining_date" id="joining_date"
                                                            class="form-control date-picker" data-date-format="dd/mm/yyyy"
                                                            placeholder="dd/mm/yyyy" min="01-01-2019"
                                                            value="{{ $user ? date('d/m/Y', strtotime($user->joining_date)) : '' }}"
                                                            required>
                                                    </div>
                                                </div>



                                            </div>
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label" for="email">Email<code>*</code></label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-right">
                                                            <em class="icon ni ni-mail"></em>
                                                        </div>
                                                        <input type="email"
                                                            pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$"
                                                            name="email" class="form-control" id="email"
                                                            value="{{ $user ? $user->email : '' }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="contact">Contact<code>*</code></label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-right">
                                                            <em class="icon ni ni-call"></em>
                                                        </div>
                                                        <input type="text" name="contact" class="form-control"
                                                            id="contact" value="{{ $user ? $user->contact : '' }}"
                                                            pattern="\d{4}\d{3}\d{4}" title="format: 0300 123 1234">
                                                    </div>
                                                </div>
                                            </div>
                                            @if (!$user)
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="form-label"
                                                            for="password">Password<code>*</code></label>
                                                        <div class="form-control-wrap">
                                                            <a href="javascript:void(0);"
                                                                class="form-icon form-icon-right passcode-switch"
                                                                data-target="password">
                                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                                <em
                                                                    class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                                            </a>
                                                            <input type="password" name="password" class="form-control"
                                                                id="password" value="" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-lg-9">
                                                <div class="row mb-4">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label"
                                                                for="designation_id">Designation<code>*</code></label>
                                                            <div class="form-control-wrap ">
                                                                <div class="form-control-select">
                                                                    <select class="form-control" name="designation_id"
                                                                        id="designation_id" required>
                                                                        <option class="form-control" value=""
                                                                            selected disabled>
                                                                            Select Designation</option>
                                                                        @foreach ($designations as $desig)
                                                                            <option
                                                                                {{ $user ? ($user->designation_id == $desig->id ? 'selected' : '') : '' }}
                                                                                value="{{ $desig->id }}">
                                                                                {{ $desig->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label" for="job_type">Work
                                                                Location<code>*</code></label>
                                                            <div class="form-control-wrap ">
                                                                <div class="form-control-select">
                                                                    <select class="form-control" name="job_type"
                                                                        id="job_type">
                                                                        <option value="" selected disabled>Select
                                                                            User Job Type
                                                                        </option>
                                                                        @if ($user)
                                                                            <option {{ $user ? 'selected' : '' }}
                                                                                value="{{ $user->job_type }}">
                                                                                {{ $user->job_type }}</option>
                                                                        @endif
                                                                        <option class="py-2" value="Inhouse">Inhouse
                                                                        </option>
                                                                        <option class="py-2" value="Remote">Remote
                                                                        </option>
                                                                        <option class="py-2" value="Hybird">Hybird
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label"
                                                                for="gender">Gender<code>*</code></label>
                                                            <div class="form-control-wrap ">
                                                                <div class="form-control-select">
                                                                    <select class="form-control" name="gender"
                                                                        id="gender" required>
                                                                        <option value="" selected disabled>Select
                                                                            Gender
                                                                        </option>
                                                                        @if ($user)
                                                                            <option {{ $user ? 'selected' : '' }}
                                                                                value="{{ $user->gender }}">
                                                                                {{ $user->gender }}</option>
                                                                        @endif
                                                                        <option value="Male">Male
                                                                        </option>
                                                                        <option value="Female">Female
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label" for="color">User
                                                                Color<code>*</code></label>
                                                            <div class="form-control-wrap ">
                                                                <div class="form-control-select">
                                                                    <select class="form-control" name="color"
                                                                        id="color">
                                                                        <option value="" selected disabled>Select
                                                                            User Color
                                                                        </option>
                                                                        @if ($user)
                                                                            <option {{ $user ? 'selected' : '' }}
                                                                                value="{{ $user->color }}">
                                                                                {{ $user->color }}</option>
                                                                        @endif
                                                                        <option class="py-2" value="#a5a7fe"
                                                                            style="background-color:#a5a7fe;">Blue
                                                                        </option>
                                                                        <option class="py-2" value="#fecd66"
                                                                            style="background-color:#fecd66;">Yellow
                                                                        </option>
                                                                        <option class="py-2" value="#67dbf4"
                                                                            style="background-color:#67dbf4;">Light
                                                                            Blue
                                                                        </option>
                                                                        <option class="py-2" value="#AAEB87"
                                                                            style="background-color:#AAEB87;">Light
                                                                            Green
                                                                        </option>
                                                                        <option class="py-2" value="#d3d6db"
                                                                            style="background-color:#d3d6db;">Smooky
                                                                            White</option>
                                                                        <option class="py-2" value="#ff8a76"
                                                                            style="background-color:#ff8a76;">Pink
                                                                        </option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label" for="dob">Date of Birth</label>
                                                            <div class="form-control-wrap">
                                                                <div class="form-icon form-icon-right">
                                                                    <em class="icon ni ni-calendar-alt"></em>
                                                                </div>
                                                                <input type="text" name="dob" id="dob"
                                                                    class="form-control date-picker"
                                                                    data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy"
                                                                    min="01-01-2007"
                                                                    value="{{ $user ? date('d/m/Y', strtotime($user->date_of_birth)) : '' }}"
                                                                    required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label" for="blood_group">Blood
                                                                Group</label>
                                                            <div class="form-control-wrap ">
                                                                <div class="form-control-select">
                                                                    <select class="form-control" name="blood_group"
                                                                        id="blood_group">
                                                                        <option value="" selected disabled>Select
                                                                            Blood Group
                                                                        </option>
                                                                        @if ($user)
                                                                            <option {{ $user ? 'selected' : '' }}
                                                                                value="{{ $user->blood_group }}">
                                                                                {{ $user->blood_group }}</option>
                                                                        @endif
                                                                        <option value="A+">A+</option>
                                                                        <option value="A-">A-</option>
                                                                        <option value="B+">B+</option>
                                                                        <option value="B-">B-</option>
                                                                        <option value="AB+">AB+</option>
                                                                        <option value="AB-">AB-</option>
                                                                        <option value="O+">O+</option>
                                                                        <option value="O-">O-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="current_address">Address
                                                                (current)</label>
                                                            <div class="form-control-wrap">
                                                                <div class="form-icon form-icon-right">
                                                                    <em class="icon ni ni-map-pin"></em>
                                                                </div>
                                                                <input type="text" name="current_address"
                                                                    class="form-control" id="current_address"
                                                                    value="{{ $user ? $user->current_address : '' }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="postal_address">Postal
                                                                Address</label>
                                                            <div class="form-control-wrap">
                                                                <div class="form-icon form-icon-right">
                                                                    <em class="icon ni ni-location"></em>
                                                                </div>
                                                                <input type="text" name="postal_address"
                                                                    class="form-control" id="postal_address"
                                                                    value="{{ $user ? $user->postal_address : '' }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="user_image">Profile Image<code>* (Size
                                                            upto 2Mb)</code></label>
                                                    <div class="form-control-wrap">
                                                        <div class="custom-file">
                                                            <input type="file" name="user_image"
                                                                class="custom-file-input" id="customFile"
                                                                value="{{ $user ? $user->image_url : 'required' }}"
                                                                onchange="readURL(this);" accept="image/*">
                                                            <label class="custom-file-label" for="user_image">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-100 d-flex justify-center">
                                                    <div class="border border-primary" style="width: 160px;">
                                                        <img class="UserimagePreview" id="UserimagePreview"
                                                            src="{{ $user ? asset($user->image_url) : '' }}"
                                                            alt="User Image Preview"
                                                            style="width: 100%;height:100%;object-fit:cover" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex" style="justify-content: right">
                                                <div class="form-group">
                                                    @if (!$user)
                                                        <button type="reset" class="btn btn-danger">Reset
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">Save User</button>
                                                    @else
                                                        <button type="submit" class="btn btn-primary">Update
                                                            User</button>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    </form>


                                </div>
                            </div><!-- .card-preview -->
                        </div> <!-- nk-block -->
                    </div><!-- .components-preview -->
                </div>
            </div>
        </div>
    </div>
    <script>
        function only_digits() {
            $('#atn_number,#contact,#amount').keypress(function(e) {
                var charCode = (e.which) ? e.which : event.keyCode;
                if (String.fromCharCode(charCode).match(/[^0-9]/g))
                    return false;

            });
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#UserimagePreview')
                        .attr('src', e.target.result);
                    $('#UserimagePreview').removeClass('d-none');
                    $('#UserimagePreview').addClass('d-flex');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function save_user() {
            let form = document.getElementById('user_form');
            let data = new FormData(form);

            function a() {
                window.location.reload();
            }
            arr = [a];

            call_ajax_with_functions('', '{{ route('user_save') }}', data, arr);
        }
    </script>
@endsection
