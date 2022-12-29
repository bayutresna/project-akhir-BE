<?php

namespace App\Http\Controllers;

use App\Models\TipeKamar;
use Illuminate\Http\Request;

class TipeKamarController extends Controller
{
    function index()
    {
        $tipekamar = TipeKamar::query()->get()->where('isdeleted',false);

        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $tipekamar
        ]);
    }
}
