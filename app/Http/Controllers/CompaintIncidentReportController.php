<?php

namespace App\Http\Controllers;

use App\Models\CompaintIncidentReport;
use App\Models\User;
use Illuminate\Http\Request;

class CompaintIncidentReportController extends Controller
{
    public function addComplainIncident(Request $request){

        $userDetails = User::where('userCode', $request->userCode)->with(['masterList'])->get()->first();

        CompaintIncidentReport::create([
            'userCode' => $request->userCode,
            'complainType' => $request->complainType,
            'description' => $request->description,
            'respondent' => $request->respondent,
            'status' => "Pending",
            'smsStatus' => "Pending",
            'smsMessage' => "Complaint/Incident Report. Complainant : Mr./Mrs./Ms " . $userDetails->masterList->lastName . " Respondent : " . $request->respondent . " Complain Type : " . $request->complainType . " " . $request->description,
        ]);

        return response()->json();
    }


    public function editComplainIncident(Request $request){
        $data = CompaintIncidentReport::find($request->complainIncidentId);
        $data->complainType = $request->complainType;
        $data->description = $request->description;
        $data->respondent = $request->respondent;
        $data->save();
        return response()->json();
    }


    public function deleteComplainIncident(Request $request){
        $data = CompaintIncidentReport::find($request->complainIncidentId);
        $data->delete();
        return response()->json();
    }

    public function actionTakenComplainIncident(Request $request){
        $data = CompaintIncidentReport::find($request->complainIncidentId);
        $data->status = "Action Taken";
        $data->save();
        return response()->json();
    }
}
