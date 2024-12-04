<?php

namespace App\Http\Controllers\SalesMobileTools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\EventCalendar;

class CalendarScheduleController extends Controller
{


    public function index()
    {
        /*$events = EventCalendar::all();
        
        $event = [];
        
        $enddate = $row->end_date." 24:00:00";

            foreach ($events as $row) {
                // code...
                $event[] = \Calendar::event(
                            $row->title,
                            true,
                            new \DateTime($row->start_date),
                            new \DateTime($row->end_date),
                            $row->id,
                        );
            }


        $calenar = \Calendar::addEvents($event);
        return view('pages.salesmobiletools.calendar.index',compact('event','calendar'));
        */
        return view('pages.salesmobiletools.calendar.index');
    }

}
