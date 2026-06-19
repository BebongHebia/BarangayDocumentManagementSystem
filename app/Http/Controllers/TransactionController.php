<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\SmsQue;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function addRequest(Request $request){
        $transaction = Transaction::create([
            'userCode' => $request->userCode,
            'type' => $request->type,
            'dateCreated' => date("m-d-Y"),
            'status' => 'Pending',
            'code' => date("Ymdhis"),
            'purpose' => $request->purpose,
            'validity' => "N/A",
            'remarks' => "N/A",
            'dateSched' => "N/A",
        ]);

        SmsQue::create([
            "userCode" => auth()->user()->userCode,
            "name" => auth()->user()->userCode,
            "phone" => auth()->user()->phone,
            "transactionCode" => $transaction->code,
            "docType" => $transaction->type,
            "smsStatus" => "Pending",
            "code" => date("Ymdhis"),
            "actType" => "Processing",
            "remarks" => "Your Request has been processed. please stay tuned to further notice and approval",
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

    public function processRequest(Request $request){
        $data = Transaction::find($request->transactionId);
        $data->remarks = $request->remarks;
        $data->status = "Processing";
        $data->save();

        $users = User::where("userCode", $request->userCode)->get()->first();

        SmsQue::create([
            "userCode" => $users->userCode,
            "name" => $users->completeName,
            "phone" => $users->phone,
            "transactionCode" => $data->code,
            "docType" => $data->type,
            "smsStatus" => "Pending",
            "code" => date("Ymdhis"),
            "actType" => "Processing",
            "remarks" => "Your Request has been processed. please stay tuned to further notice and approval",
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Request added successfully',
            'redirect_url' => url('/transactions')
        ]);


    }


    public function approveRequest(Request $request){
        $user = User::where("userCode", $request->userCode)->get()->first();
        $transaction = Transaction::where("code", $request->transactionCode)->get()->first();
        if ($transaction) {
            $transaction->update([
                'dateSched' => $request->dateSched,
                'remarks' => "Your requested document : " . $transaction->type . " is now approved. You may claim it from the Barangay Admin Building",
                'validity' => $request->validity,
                'status' => 'Approved'
            ]);
        }

        SmsQue::create([
            "userCode" => $user->userCode,
            "name" => $user->completeName,
            "phone" => $user->phone,
            "transactionCode" => $transaction->code,
            "docType" => $transaction->type,
            "smsStatus" => "Pending",
            "code" => date("Ymdhis"),
            "actType" => "Approved",
            "remarks" => "Your requested document : " . $transaction->type . " is now approved. You may claim it from the Barangay Admin Building",
        ]);

        Payment::create([
            'userCode' => $request->userCode,
            'tranCode' => $transaction->code,
            'cedulaNo' => $request->cedulaNo,
            'cedIssOn' => $request->cedIssOn,
            'cedIssAt' => $request->cedIssAt,
            'cedAmount' => $request->cedAmount,
            'orNo' => $request->orNo,
            'orIssOn' => $request->orIssOn,
            'orIssAt' => $request->orIssAt,
            'orAmount' => $request->orAmount,
            'docAmount' => $request->docAmount,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Request Approved',
            'redirect_url' => url('/transactions/print-transaction/transaction-code=' . $transaction->code)
        ]);

    }

    public function rejectRequest(Request $request){
        $user = User::where("userCode", $request->userCode)->get()->first();
        $transaction = Transaction::where("code", $request->transactionCode)->get()->first();
        if ($transaction) {
            $transaction->update([
                'remarks' => $request->remarks,
                'status' => 'Rejected'
            ]);
        }

        SmsQue::create([
            "userCode" => $user->userCode,
            "name" => $user->completeName,
            "phone" => $user->phone,
            "transactionCode" => $transaction->code,
            "docType" => $transaction->type,
            "smsStatus" => "Pending",
            "code" => date("Ymdhis"),
            "actType" => "Rejected",
            "remarks" => "Your requested document : " . $transaction->type . " is Reject. Please open BDMS website to know more",
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Request Approved',
            'redirect_url' => url('/transactions')
        ]);
    }


}