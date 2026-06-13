<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function addRequest(Request $request){
        Transaction::create([
            'userCode' => $request->userCode,
            'type' => $request->type,
            'dateCreated' => date("m-d-Y"),
            'status' => 'Pending',
            'code' => date("Ymdhis"),
            'purpose' => $request->purpose,
            'validity' => "N/A",
            'remarks' => "N/A",
        ]);

        if (auth()->user()->role == "Admin"){
            return response()->json();
        }else{
            return response()->json([
                'success' => true,
                'message' => 'Request added successfully',
                'redirect_url' => url('/transactions')
            ]);
        }
    }

    public function editTransaction(Request $request){
        $data = Transaction::find($request->transactionId);
        $data->type = $request->type;
        $data->purpose = $request->purpose;
        $data->save();
        return response()->json();
    }

    public function deleteTransaction(Request $request){
        $data = Transaction::find($request->transactionId);
        $data->delete();
        return response()->json();
    }
}