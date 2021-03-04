<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AlertController extends Controller
{
    public function noAccessMessage()
    {
        Alert::warning('دسترسی مقدور نیست', 'شما اجازه دسترسی به این صفحه را ندارید');
    }
}
