<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    function index(){
        $foto = Gallery::query()->get()->where('isdeleted',false);
        return response()->json([
            'statu' => true,
            'message' => '',
            'data' => $foto
        ]);
    }

    function store(Request $req){
        $file = $req->file('foto');
        if(!$file){
            return response()->json([
                'status' =>false,
                'message' => 'foto tak boleh kosong',
                'data' =>null
            ]);
        }

        $filename = $file->hashName();
        $file->move("gallery", $filename);
        //pembuatan url foto
        $path = $req->getSchemeAndHttpHost() . "/gallery/" . $filename;
        $payload['foto'] = $path;
        $galeri = Gallery::query()->create($payload);

        return response()->json([
            'status' =>true,
            'message' => 'data masuk',
            'data' =>$galeri
        ]);
    }

    function delete($id){
        $galeri = Gallery::query()->where('id', $id)->first();
        $galeri->isdeleted = true;
        $galeri->save();
    }
}
