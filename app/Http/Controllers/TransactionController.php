<?php

namespace App\Http\Controllers;

use App\Models\Attestation;
use App\Models\BarangayClearance;
use App\Models\BarangayIdentification;
use App\Models\BarangayIndigent;
use App\Models\BarCert;
use App\Models\Payment;
use App\Models\SmsQue;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{


    public function createBarIndigent(Request $request){

        $data =  Transaction::create([
            'userCode' => $request->userCode,
            'type' =>  $request->indigentType,
            'dateCreated' => date("d-m-Y"),
            'status' => "Pending",
            'code' => date("Ymdhis"),
            'validity' => "N/A",
            'remarks' => "N/A",
            'dateSched' => "N/A",
            'issueDate' => "N/A",
        ]);

        $users = User::where("userCode", $request->userCode)->get()->first();

        BarangayIndigent::create([
            'userCode' => $request->userCode,
            'code' => date("Ymdhis"),
            'sector' => $request->sector,
            'isAuthorized' => $request->isAuthorized,
            'authorized' => $request->authorized,
            'relation' => $request->relation,
            'purposeType' => $request->purposeType,
            'purpose' => $request->purpose,
            'dayIssue' => 'N/A',
            'monthIssue' => 'N/A',
            'transactionCode' => $data->code,
        ]);

        SmsQue::create([
            "userCode" => $users->userCode,
            "name" => $users->completeName,
            "phone" => $users->phone,
            "transactionCode" => $data->code,
            "docType" => $data->type,
            "smsStatus" => "Pending",
            "code" => date("Ymdhis"),
            "actType" => "Pending",
            "remarks" => "Your Request has been processed. please stay tuned to further notice and approval",
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Request added successfully',
            'redirect_url' => url('/transactions')
        ]);
    }

    public function editBarIndigent(Request $request){
        $data = BarangayIndigent::find($request->barIndigentId);
        $data->purposeType = $request->purposeType;
        $data->purpose = $request->purpose;
        $data->save();

        return response()->json();
    }

    public function deleteBarIndigent(Request $request){
        $data = BarangayIndigent::find($request->barIndigentId);
        $data->delete();
        $transaction = Transaction::where('code', $data->transactionCode)->get()->first();
        $transaction->delete();
        return response()->json();
    }

    public function createBarIden(Request $request){
        $data =  Transaction::create([
            'userCode' => $request->userCode,
            'type' =>  "Barangay Identification",
            'dateCreated' => date("d-m-Y"),
            'status' => "Pending",
            'code' => date("Ymdhis"),
            'validity' => "N/A",
            'remarks' => "N/A",
            'dateSched' => "N/A",
            'issueDate' => "N/A",
        ]);

        $users = User::where("userCode", $request->userCode)->get()->first();

        BarangayIdentification::create([
            'userCode' => $request->userCode,
            'code' => date("Ymdhis"),
            'sector' => $request->sector,
            'dayIssue' => "N/A",
            'monthIssue' => "N/A",
            'transactionCode' => $data->code,
        ]);

        SmsQue::create([
            "userCode" => $users->userCode,
            "name" => $users->completeName,
            "phone" => $users->phone,
            "transactionCode" => $data->code,
            "docType" => $data->type,
            "smsStatus" => "Pending",
            "code" => date("Ymdhis"),
            "actType" => "Pending",
            "remarks" => "Your Request has been processed. please stay tuned to further notice and approval",
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Request added successfully',
            'redirect_url' => url('/transactions')
        ]);
    }

    public function deleteBarIden(Request $request){
        $data = BarangayIdentification::find($request->barIdenId);
        $data->delete();
        $transaction = Transaction::where('code', $data->transactionCode)->get()->first();
        $transaction->delete();
        return response()->json();
    }


    public function createBarClear(Request $request){
        $data =  Transaction::create([
            'userCode' => $request->userCode,
            'type' =>  "Barangay Clearance",
            'dateCreated' => date("d-m-Y"),
            'status' => "Pending",
            'code' => date("Ymdhis"),
            'validity' => "N/A",
            'remarks' => "N/A",
            'dateSched' => "N/A",
            'issueDate' => "N/A",
        ]);

        $users = User::where("userCode", $request->userCode)->get()->first();

        BarangayClearance::create([
            'userCode' => $request->userCode,
            'code' => date("Ymdhis"),
            'sector' => $request->sector,
            'purpose' => $request->purpose,
            'purposeType' => $request->purposeType,
            'dayIssue' => "N/A",
            'monthIssue' => "N/A",
            'transactionCode' => $data->code,
        ]);

        SmsQue::create([
            "userCode" => $users->userCode,
            "name" => $users->completeName,
            "phone" => $users->phone,
            "transactionCode" => $data->code,
            "docType" => $data->type,
            "smsStatus" => "Pending",
            "code" => date("Ymdhis"),
            "actType" => "Pending",
            "remarks" => "Your Request has been processed. please stay tuned to further notice and approval",
        ]);

         return response()->json([
            'success' => true,
            'message' => 'Request added successfully',
            'redirect_url' => url('/transactions')
        ]);
    }

    function deleteBarClear(Request $request){
        $data = BarangayClearance::find($request->barClearId);
        $data->delete();
        $transaction = Transaction::where('code', $data->transactionCode)->get()->first();
        $transaction->delete();
        return response()->json();
    }

    public function editBarClear(Request $request){
        $data = BarangayClearance::find($request->barClearId);
        $data->sector = $request->sector;
        $data->purpose = $request->purpose;
        $data->purposeType = $request->purposeType;
        $data->save();
        return response()->json();
    }


    public function createBarCert(Request $request){
        $data =  Transaction::create([
            'userCode' => $request->userCode,
            'type' =>  $request->isType,
            'dateCreated' => date("d-m-Y"),
            'status' => "Pending",
            'code' => date("Ymdhis"),
            'validity' => "N/A",
            'remarks' => "N/A",
            'dateSched' => "N/A",
            'issueDate' => "N/A",
        ]);

        BarCert::create([
            'userCode' => $request->userCode,
            'code' => date("Ymdhis"),
            'sector' => $request->sector,
            'residentYears' => $request->residentYears,
            'purposeType' => $request->purposeType,
            'purpose' => $request->purpose,
            'isFirstTimeJobSeeker' => $request->isFirstTimeJobSeeker,
            'dayIssue' => "N/A",
            'monthIssue' => "N/A",
            'transactionCode' => $data->code,
        ]);

        $users = User::where("userCode", $request->userCode)->get()->first();

        SmsQue::create([
            "userCode" => $users->userCode,
            "name" => $users->completeName,
            "phone" => $users->phone,
            "transactionCode" => $data->code,
            "docType" => $data->type,
            "smsStatus" => "Pending",
            "code" => date("Ymdhis"),
            "actType" => "Pending",
            "remarks" => "Your Request has been processed. please stay tuned to further notice and approval",
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Request added successfully',
            'redirect_url' => url('/transactions')
        ]);

    }

    public function editBarCertReg(Request $request){
        $data = BarCert::find($request->barCertRegId);
        $data->sector = $request->sector;
        $data->residentYears = $request->residentYears;
        $data->purposeType = $request->purposeType;
        $data->purpose = $request->purpose;
        $data->save();

        return response()->json();
    }

    public function deleteBarCertReg(Request $request){
        $data = BarCert::find($request->barCertRegId);
        $data->delete();
        $transaction = Transaction::where('code', $data->transactionCode)->get()->first();
        $transaction->delete();

        return response()->json();
    }

    public function createAttestation(Request $request){
       $data =  Transaction::create([
            'userCode' => $request->userCode,
            'type' => "Attestation",
            'dateCreated' => date("d-m-Y"),
            'status' => "Pending",
            'code' => date("Ymdhis"),
            'validity' => "N/A",
            'remarks' => "N/A",
            'dateSched' => "N/A",
            'issueDate' => "N/A",
        ]);

        $users = User::where("userCode", $request->userCode)->get()->first();

        Attestation::create([
            'code' => date("Ymdhis"),
            'userCode' => $request->userCode,
            'age' => $request->age,
            'status' => $request->status,
            'income' => $request->income,
            'typeOfAssistance' => $request->typeOfAssistance,
            'totalMonthlyHousholdExpense' => $request->totalMonthlyHousholdExpense,
            'transactionCode' => $data->code,
        ]);

        SmsQue::create([
            "userCode" => $users->userCode,
            "name" => $users->completeName,
            "phone" => $users->phone,
            "transactionCode" => $data->code,
            "docType" => $data->type,
            "smsStatus" => "Pending",
            "code" => date("Ymdhis"),
            "actType" => "Pending",
            "remarks" => "Your Request has been processed. please stay tuned to further notice and approval",
        ]);



        return response()->json([
            'success' => true,
            'message' => 'Request added successfully',
            'redirect_url' => url('/transactions')
        ]);
    }

    public function editAttestation(Request $request){
        $data = Attestation::find($request->attestationId);
        $data->status = $request->status;
        $data->income = $request->income;
        $data->typeOfAssistance = $request->typeOfAssistance;
        $data->totalMonthlyHousholdExpense = $request->totalMonthlyHousholdExpense;
        $data->save();
        return response()->json();
    }

    public function deleteAttestation(Request $request){
        $data = Attestation::find($request->attestationId);
        $data->delete();

        $transaction = Transaction::where('code', $data->transactionCode)->get()->first();
        $transaction->delete();

        return response()->json();
    }

    public function setProcess(Request $request){

        $remarks = $request->remarks ? $request->remakrs : "N/A";

        $data = Transaction::where('code', $request->transactionCode)->first();
        $data->status = "Processing";
        $data->remarks = $remarks;
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
            "remarks" => "Your Request has been processed. please stay updated to further notice and approval",
        ]);

        return response()->json([
            'success' => true,
            'redirect_url' => url('/transactions')
        ]);
    }

    public function setRejected(Request $request){
        $remarks = $request->remarks ? $request->remakrs : "N/A";

        $data = Transaction::where('code', $request->transactionCode)->first();
        $data->status = "Rejected";
        $data->remarks = $remarks;
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
            "remarks" => "Your Request has been Rejected. Please open BDMS Site to know the reasons",
        ]);

        return response()->json([
            'success' => true,
            'redirect_url' => url('/transactions')
        ]);
    }


     public function setApprove(Request $request){
        $user = User::where("userCode", $request->userCode)->get()->first();
        $transaction = Transaction::where("code", $request->transactionCode)->get()->first();
        if ($transaction) {
            $transaction->update([
                'remarks' => "Your requested document : " . $transaction->type . " is now approved. You may claim it from the Barangay Admin Building",
                'status' => 'Approved',
                'dateSched' => $request->dateSched
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

        return response()->json([
            'success' => true,
            'message' => 'Request Approved',
            'redirect_url' => url('/transactions')
        ]);

    }

    public function setCompleted(Request $request){
        $user = User::where("userCode", $request->userCode)->get()->first();
        $transaction = Transaction::where("code", $request->transactionCode)->get()->first();
        if ($transaction) {
            $transaction->update([
                'remarks' => "Your requested document : " . $transaction->type . " is now Completed.",
                'status' => 'Completed',
                'dateSched' => $request->dateSched
            ]);
        }

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

        SmsQue::create([
            "userCode" => $user->userCode,
            "name" => $user->completeName,
            "phone" => $user->phone,
            "transactionCode" => $transaction->code,
            "docType" => $transaction->type,
            "smsStatus" => "Pending",
            "code" => date("Ymdhis"),
            "actType" => "Approved",
            "remarks" => "Your requested document : " . $transaction->type . " is now Completed.",
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Request Approved',
            'redirect_url' => url('/transactions/print-transaction/transaction-code=' . $transaction->code)
        ]);
    }

}