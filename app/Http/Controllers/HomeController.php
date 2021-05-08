<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
    }
    /**
     * @param Request $request
     * @return false|string
     * @throws \JsonException
     */
    public function getJson_encode($array)
    {
        return json_encode($array, JSON_THROW_ON_ERROR | true |  JSON_UNESCAPED_UNICODE);
    }

}
