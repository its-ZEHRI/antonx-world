<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Event;
use App\Models\EventAttendee;
use Illuminate\Contracts\View\View;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('role');
    }

    public function index(Request $request)
    {
        $data['page_title'] = "AntonX- Events List";

        if ($request->filter == 'past') {
            $data['event_users'] = Event::where('date', '<', get_date())
                ->with(['attendees', 'attendees.user'])->orderBy('date', 'DESC')->get();
            $data['v'] = 'Past';
        } elseif ($request->filter == 'all') {
            $data['event_users'] = Event::with(['attendees', 'attendees.user'])->orderBy('date', 'DESC')->get();
            $data['v'] = 'All';
        } else {
            $data['event_users'] = Event::whereDate('date', '>', get_date())
                ->with(['attendees', 'attendees.user'])->orderBy('date', 'DESC')->get();
            $data['v'] = 'Upcoming';
        }

        return view('events.events_list', $data);
    }

    function save_event_attendee(Request $request)
    {
        if ($request->user_id == 1) {
            $response['status'] = 'failure';
            $response['result'] = 'This is not a valid user! re-login by your own credential';
            return response()->json($response);
        }
        if ($request->event_id == '' && $request->user_id == '') {
            $response['status'] = 'failure';
            $response['result'] = 'User or Event information is not valid!';
            return response()->json($response);
        }

        $event =  Event::where('id', $request->event_id)->get()[0];

        if ($event->date < get_date()) {
            $response['status'] = 'failure';
            $response['result'] = 'This event is passed';
            return response()->json($response);
        }

        $check = EventAttendee::where('event_id', $request->event_id)->where('user_id', $request->user_id)->get();

        if (count($check) > 0) {
            $response['status'] = "Failure";
            $response['result'] = "You Are Already Added To This Event";
            return response()->json($response);
        } else {
            $data = [
                'event_id' => $request->event_id,
                'user_id' => $request->user_id,
                'event_date' => $event->date,
                'event_time' => $event->event_time,
            ];
            EventAttendee::create($data);
            $response['status'] = 'Success';
            $response['result'] = 'Added Successfully';
            return response()->json($response);
        }
    }

    public function show_form(Request $request)
    {
        $data['page_title'] = "Event Form";
        if (isset($request->id)) {
            $data['event'] =  Event::where('id', $request->id)->get()[0];
        } else {
            $data['event'] = false;
        }

        return view('events.events_form', $data);
    }

    public function save(Request $request)
    {
        $result[] = '';
        if ($request->date < get_date() && $request->event_time < get_time()) {

            $response['status'] = 'Failure';
            $response['result'] = 'Time and Date is passed!';
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'location' => 'required',
            'description' => 'required',
            'date' => 'required',
            'event_time' => 'required',
        ]);
        if ($validator->passes()) {
            $data = [
                'title' => $request->title,
                'location' => $request->location,
                'description' => $request->description,
                'date' => date('Y-m-d', strtotime($request->date)),
                'event_time' => $request->event_time,
            ];
            if (isset($request->id)) {
                $data['updated_by'] = Auth::user()->id;
                Event::where('id', $request->id)->update($data);
            } else {
                $data['created_by'] = Auth::user()->id;
                Event::create($data);
            }
            $response['status'] = 'Success';
            $response['result'] = 'Added Successfully';
        } else {
            $response['status'] = 'failure';
            $response['result'] = $result;
        }

        return response()->json($response);
    }

    public function delete(Request $request)
    {
        Event::where('id', $request->id)->delete();
        $response['status'] = "Success";
        $response['result'] = "Deleted Successfully";
        return response()->json($response);
    }
}
