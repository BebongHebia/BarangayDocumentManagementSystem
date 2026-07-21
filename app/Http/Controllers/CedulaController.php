<?php

namespace App\Http\Controllers;

use App\Models\Cedula;
use Illuminate\Http\Request;

class CedulaController extends Controller
{
    public function addCedula(Request $request){
        Cedula::create([
            'userCode' => $request->userCode,
            'cedulaNo' => $request->cedulaNo,
            'dateAcquired' => $request->dateAcquired,
            'validity' => $request->validity,
        ]);
        return response()->json();
    }

    public function editCedula(Request $request){
        $data = Cedula::find($request->cedId);
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
