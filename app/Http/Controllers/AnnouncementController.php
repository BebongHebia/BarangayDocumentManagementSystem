<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function addAnnouncement(Request $request){
        Announcement::create([
            "title" => $request->title,
            "description" => $request->description,
            "what" => $request->what,
            "when" => $request->when,
            "where" => $request->where,
            "how" => $request->how,
            "code" => date("Ymdhis"),
        ]);

        return response()->json();
    }


    public function editAnnouncement(Request $request){
        $data = Announcement::find($request->annId);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->what = $request->what;
        $data->when = $request->when;
        $data->where = $request->where;
        $data->how = $request->how;
        $data->save();
        return response()->json();
    }

    public function deleteAnnouncement(Request $request){
        $data = Announcement::find($request->annId);
        $data->delete();
        return response()->json();
    }
}