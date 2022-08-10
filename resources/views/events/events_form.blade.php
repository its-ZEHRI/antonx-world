<form method="post" id="event_form" action="javascript:save_event();" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <div class="col-lg-6">
            @if ($event)
                <input type="hidden" value="{{ $event->id }}" name="id">
            @endif
            <div class="form-group">
                <label class="form-label" for="title">Event Title<code>* </code></label>
                <div class="form-control-wrap">
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ $event ? $event->title : '' }}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label class="form-label" for="date">Event Date<code>* </code></label>
                <div class="form-control-wrap">
                    <input type="Date" class="form-control" id="date" min="2022" name="date"
                        value="{{ $event ? $event->date : '' }}" required>
                </div>
                {{-- <div class="form-note">Date format <code>dd/mm/yyyy</code></div> --}}
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label class="form-label" for="event_time">Event Time<code>* </code></label>
                <div class="form-control-wrap">
                    <input type="time" name="event_time" class="form-control" id="event_time"
                        value="{{ $event ? $event->event_time : '' }}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label" for="location">Event Location<code>* </code></label>
                <div class="form-control-wrap">
                    <input type="text" class="form-control" id="location" name="location"
                        value="{{ $event ? $event->location : '' }}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label" for="cf-default-textarea">Event Description<code>* </code></label>
                <div class="form-control-wrap">
                    <textarea class="form-control form-control-sm" id="description" name="description"
                        value="{{ $event ? $event->description : '' }}" required>{{ $event ? $event->description : '' }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex" style="justify-content: right">
            <div class="form-group">
                <button type="reset" class="btn btn-danger">Reset
                </button>
                <button type="submit" class="btn btn-primary">Save Event</button>
            </div>
        </div>
    </div>
</form>
