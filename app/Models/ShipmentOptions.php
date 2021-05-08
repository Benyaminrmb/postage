<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentOptions extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'type',
        'data',
        'agency_id',
        'default',
    ];
    public function agency()
    {
        return $this->belongsTo(User::class);
    }
}
