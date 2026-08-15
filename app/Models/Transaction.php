<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'userCode',
        'type',
        'dateCreated',
        'status',
        'code',
        'validity',
        'remarks',
        'dateSched',
        'issueDate',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'userCode', 'userCode');
    }

    public function payment(){
        return $this->belongsTo(Payment::class, 'code', 'tranCode');
    }

    public function cedula(){
        return $this->hasOne(Cedula::class, 'userCode', 'userCode')
                ->latest('id');
    }

    public function attestation_details(){
        return $this->belongsTo(Attestation::class, 'code', 'transactionCode');
    }

    public function bar_cert_reg_details(){
        return $this->belongsTo(BarCert::class, 'code', 'transactionCode');
    }
    public function bar_clear_details(){
        return $this->belongsTo(BarangayClearance::class, 'code', 'transactionCode');
    }

    public function bar_iden_details(){
        return $this->belongsTo(BarangayIdentification::class, 'code', 'transactionCode');
    }

    public function bar_indigent_details(){
        return $this->belongsTo(BarangayIndigent::class, 'code', 'transactionCode');
    }
}