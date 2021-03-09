<?php

namespace App\Models;

use App\Http\Controllers\Api\ApiTokenController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=[
        'name',
        'email',
        'password',
        'userType',
        'client_id',
        'member_id',
        'name',
        'family',
        'mobile',
        'telephone',
        'email',
        'password',
        'gender',
        'birthday',
        'address',
        'token',
        'token_expired_at',
        'nationalCode',
        'register_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden=[
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts=[
        'email_verified_at'=>'datetime',
    ];

    public function shipments()
    {
        return $this->hasMany(Shipment::class, 'user_id', 'id');
    }

    public function agencyShipments()
    {
        return $this->hasMany(Shipment::class, 'agency_id', 'id');
    }

    public function getNewToken()
    {
        $ApiTokenController=new ApiTokenController();
        return $ApiTokenController->generateToken();
    }


}
