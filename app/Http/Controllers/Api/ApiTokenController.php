<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class ApiTokenController extends Controller
{
    public function generateToken()
    {
        $token = Str::random(120);
        return hash('sha256', $token);
    }
}
