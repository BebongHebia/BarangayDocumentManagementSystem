<?php

namespace App\Http\Controllers;

use App\Models\MasterList;
use Illuminate\Http\Request;

class MasterListController extends Controller
{
    public function addMasterLists(Request $request){
        MasterList::create([
            "listCode" => $request->listCode,
            "firstName" => $request->firstName,
            "middleName" => $request->middleName,
            "lastName" => $request->lastName,
            "status" => "Active",
        ]);

        return response()->json();
    }

    public function editMasterLists(Request $request){
        $data = MasterList::find($request->listId);
        $data->listCode = $request->listCode;
        $data->firstName = $request->firstName;
        $data->middleName = $request->middleName;
        $data->lastName = $request->lastName;
        $data->status = $request->status;
        $data->save();
        return response()->json();
    }

    public function deleteMasterLists(Request $request){
        $data = MasterList::find($request->listId);
        $data->delete();
        return response()->json();
    }
}
