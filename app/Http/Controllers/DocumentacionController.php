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
        $json_file      = json_decode($file_content, true);
        // -----------------------------------------------
        $env_content    = Storage::get('public/environment_api_itau_canje_compra-local.postman_environment.json');
        $json_env       = json_decode($env_content, true);
        $arr_env        = [];
        // -----------------------------------------------
        foreach ($json_env['values'] as $k => $v) {
            $arr_env[$v['key']] = $v;
        }
        // -----------------------------------------------
        $title          = $json_file['info']['name'];
        $description    = $json_file['info']['description'];
        $item           = $json_file['item'];

        // -----------------------------------------------
        return view('documentacion')->with([
            'json'          => $json_file,
            'titulo'        => $title,
            'descripcion'   => $description,
            'item'          => $item,
            'env'           => $arr_env,
        ]);
    }
}
