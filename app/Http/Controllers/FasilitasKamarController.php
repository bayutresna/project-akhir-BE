<?php

namespace App\Http\Controllers;

use App\Models\FasilitasKamar;
use Illuminate\Http\Request;

class FasilitasKamarController extends Controller
{
    function index()
    {
        $fasilitaskamar = FasilitasKamar::query()->get()->where('isdeleted',false);

        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $fasilitaskamar
        ]);
    }
    function store(Request $req){
        $payload = $req->all();

        $fasilitaskamar = FasilitasKamar::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "data masuk",
            "data" => $fasilitaskamar
        ]);
    }
}
