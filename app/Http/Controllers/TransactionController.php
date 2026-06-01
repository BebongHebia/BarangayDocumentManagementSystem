<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function createTransaction(Request $request){
        Transaction::create([
            'userCode' => auth()->user()->userCode,
            'type' => $request->type,
            'dateCreated' => date('Y-m-d'),
            'status' => "Pending",
            'code' => $request->code,
            'purpose' => $request->purpose,
            'validity' => date('Y-m-d'),
        ]);

        return redirect('/view-transaction/code=' . $request->code);
    }
}