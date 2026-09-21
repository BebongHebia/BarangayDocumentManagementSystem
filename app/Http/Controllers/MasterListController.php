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
            "suffix" => $request->suffix,
            "birthdate" => $request->birthdate,
            "placeOfBirth" => $request->placeOfBirth,
            "sex" => $request->sex,
            "bloodType" => $request->bloodType,
            "civilStatus" => $request->civilStatus,
            "religion" => $request->religion,
            "purok" => $request->purok,
            "address" => $request->address,
            "citizenship" => $request->citizenship,
            "profession" => $request->profession,
            "contact" => $request->contact,
            "email" => $request->email,
            "educationalAtt" => $request->educationalAtt,
            "resType" => $request->resType,
            "status" => "Active",
        ]);

        return response()->json();
    }

    public function editMasterLists(Request $request){
        $data = MasterList::find($request->masterListId);
        $data->listCode = $request->listCode;
        $data->firstName = $request->firstName;
        $data->middleName = $request->middleName;
        $data->lastName = $request->lastName;
        $data->suffix = $request->suffix;
        $data->birthdate = $request->birthdate;
        $data->placeOfBirth = $request->placeOfBirth;
        $data->sex = $request->sex;
        $data->bloodType = $request->bloodType;
        $data->civilStatus = $request->civilStatus;
        $data->religion = $request->religion;
        $data->purok = $request->purok;
        $data->address = $request->address;
        $data->citizenship = $request->citizenship;
        $data->profession = $request->profession;
        $data->contact = $request->contact;
        $data->email = $request->email;
        $data->educationalAtt = $request->educationalAtt;
        $data->resType = $request->resType;
        $data->save();
        return response()->json();
    }

    public function deleteMasterLists(Request $request){
        $data = MasterList::find($request->listId);
        $data->delete();
        return response()->json();
    }
}
