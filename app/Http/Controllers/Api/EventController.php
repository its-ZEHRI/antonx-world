<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventAttendee;
use App\Models\User;

class EventController extends Controller
{

    public function index()
    {
        $event = Event::with('attendees')->orderBy('date', 'ASC')->get();

        if (!$event) {
            return response()->json(['success' => false, 'error' => 'Data Not Available', 'events' => null], 401);
        }

        return response()->json(['success' => true, 'error' => null, 'events' => ['event' => $event]], 200);
    }

    public function save_event_attendee(Request $request)
    {
        $event =  Event::find($request->event_id);
        $user = User::find($request->user()->id);
        $check = EventAttendee::where('event_id', $request->event_id)->where('user_id', $request->user()->id)->get();

        if ($event == null) {
            return response()->json(['success' => false, 'error' => 'Sorry! No Event found or this Event passed please contact to HR team', 'body' => null], 200);
        }

        if ($user == null) {
            return response()->json(['success' => false, 'error' => 'Sorry! No User found, please contact to HR team', 'body' => null], 200);
        }

        if ($event->date < get_date()) {
            return response()->json(['success' => false, 'error' => 'This event Date is passed', 'body' => null], 200);
        }

        if ($event->time > get_time()) {
            return response()->json(['success' => false, 'error' => 'This event Time is passed', 'body' => null], 200);
        }

        if (count($check) > 0) {
            return response()->json(['success' => false, 'error' => 'You Are Already Added To This Event', 'body' => null], 200);
        }

        $data = [
            'event_id' => $request->event_id,
            'user_id' => $request->user()->id,
            'event_date' => $event->date,
            'event_time' => $event->event_time,
        ];

        EventAttendee::create($data);

        return response()->json(['success' => true, 'error' => 'null', 'body' => 'Thank You for Joining Us!'], 200);
    }
}
