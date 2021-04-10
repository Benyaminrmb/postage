<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'agency_id',
        'deliveryType',
        'originAddress',
        'destinationAddress',
        'receiverInformation',
        'deliveryVehicle',
        'postalInformation',
        'accessResponse',
        'stepStatus',
        'dataResponse',
        'ordered_at',
        'seen_at',
        'response_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agency()
    {
        return $this->belongsTo(User::class,'agency_id','id','users');
    }

}
