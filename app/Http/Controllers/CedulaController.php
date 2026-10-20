<?php

namespace App\Http\Controllers;

use App\Models\Cedula;
use Illuminate\Http\Request;

class CedulaController extends Controller
{

    public function addCedula(Request $request){

        if ($request->cedulaResType == "Resident"){
            Cedula::create([
            'resType' => $request->cedulaResType,
            'userCode' => $request->userCode,
            'cedulaNo' => $request->cedulaNo,
            'dateAcquired' => $request->dateAcquired,
            'validity' => $request->validity,
            'completeName' => $request->completeName,
            'address' => $request->address,
            'placeOfBirth' => $request->placeOfBirth,
            'dateOfBirth' => $request->dateOfBirth,
            'civilStatus' => $request->civilStatus,
            'height' => $request->height,
            'weight' => $request->weight,
           ]);
        }else{
            Cedula::create([
            'resType' => $request->cedulaResType,
            'userCode' => "0",
            'cedulaNo' => $request->cedulaNo,
            'dateAcquired' => $request->dateAcquired,
            'validity' => $request->validity,
            'completeName' => $request->completeName,
            'address' => $request->address,
            'placeOfBirth' => $request->placeOfBirth,
            'dateOfBirth' => $request->dateOfBirth,
            'civilStatus' => $request->civilStatus,
            'height' => $request->height,
            'weight' => $request->weight,
           ]);
        }

        
        return response()->json();
       
    }

    public function editCedula(Request $request){
        $data = Cedula::find($request->cedId);
        $data->completeName = $request->completeName;
        $data->address = $request->address;
        $data->placeOfBirth = $request->placeOfBirth;
        $data->dateOfBirth = $request->dateOfBirth;
        $data->civilStatus = $request->civilStatus;
        $data->height = $request->height;
        $data->weight = $request->weight;
        $data->userCode = $request->userCode;
        $data->cedulaNo = $request->cedulaNo;
        $data->dateAcquired = $request->dateAcquired;
        $data->validity = $request->validity;
        $data->save();
    }


    public function deleteCedula(Request $request){
        $data = Cedula::find($request->cedId);
        $data->delete();
    }
}
