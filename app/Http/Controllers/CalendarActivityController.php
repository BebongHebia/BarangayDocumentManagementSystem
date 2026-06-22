<?php

namespace App\Http\Controllers;

use App\Models\CalendarActivity;
use Illuminate\Http\Request;

class CalendarActivityController extends Controller
{
    public function addCalendarActivity(Request $request){
    
        CalendarActivity::create([
            'code' => date("Ymdhis"),
            'activity' => $request->activity,
            'description' => $request->description,
            'dateStart' => $request->dateStart,
            'dateEnd' => $request->dateEnd,
            'status' => "Upcoming",
        ]);

        return response()->json();
    
    }


    public function editCalendarActivity(Request $request){
        $calAct = CalendarActivity::find($request->calendarActId);
        $calAct->activity = $request->activity;
        $calAct->description = $request->description;
        $calAct->dateStart = $request->dateStart;
        $calAct->dateEnd = $request->dateEnd;
        $calAct->status = $request->status;
        $calAct->save();
        return response()->json();
    }

    public function deleteCalendarActivity(Request $request){
        $calAct = CalendarActivity::find($request->calendarActId);
        $calAct->delete();
        return response()->json();
    }
}