<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentacionController extends Controller
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
     * Show the application documentacion.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $file_content   = Storage::get('public/API-ITAU-CANJE-COMPRA.postman_collection.json');
        $json           = json_decode($file_content, true);
        return view('documentacion')->with('json', $json);
    }
}
