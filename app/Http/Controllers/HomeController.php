<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Certificate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['home', 'index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $po = $request->get('po');
        $part = $request->get('part');
        $lot = $request->get('lot');

        $certificate = null;
        $searched = false;
        
        // Are we performing a search?
        if (!empty($po) && !empty($part) && !empty($lot)) {
            $certificate = Certificate::where('po', $po)
                ->where('part', $part)
                ->where('lot', $lot)
                ->first();

            $searched = true;
        }
        
        return view('home', ['cert' => $certificate, 'search' => $searched]);
    }
}
