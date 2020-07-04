<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    protected $Extrafuntions;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ExtraFunctionsController $Extrafuntions)
    {
        $this->middleware('auth');
        $this->Extrafuntions = $Extrafuntions;
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
}
