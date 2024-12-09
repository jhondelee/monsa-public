<?php

namespace App\Http\Controllers\SalesMobileTools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\EventCalendar;
use Carbon\Carbon;

class CalendarScheduleController extends Controller
{


    public function index()
    {
        
        $scheds = EventCalendar::whereMonth("start_date",">=",Carbon::now()->month()->format('m'))
                    ->orderBy('start_date')->get();
            

        $events = array();

            $bookings = EventCalendar::all();

                foreach($bookings as $booking) {
                    $color = null;
                    if($booking->title == 'Test') {
                        $color = '#924ACE';
                    }
                    if($booking->title == 'Test 1') {
                        $color = '#68B01A';
                    }

                    $events[] = [
                        'id'    => $booking->id,
                        'title' => $booking->title,
                        'start' => $booking->start_date,
                        'end'   => $booking->end_date,
                        'color' => $color
                    ];
                }

        return view('pages.salesmobiletools.calendar.index',compact('events','bookings','scheds'));
    }

    public function store(Request $request)
    {   
        $this->validate($request, ['title' => 'required',]);

        $event = New EventCalendar;

        $event->user_id = Auth()->user()->id;

        $event->title = $request->title;

        $event->start_date = $request->start_date;

        $event->end_date = $request->end_date;

        $event->save();



        return redirect()->route('calendar.index')

            ->with('success','Event title been saved successfully.');
    }

    public function events(Request $request)
    {
        
        $results = EventCalendar::where("start_date",">", Carbon::now()->subMonths(6))->get();  

        return response()->json($results);       
        
    }

}
