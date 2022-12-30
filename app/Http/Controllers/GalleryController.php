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

    function update(Request $request, $id)
    {
        $Gallery = Gallery::query()->where("id", $id)->where('isdeleted',false)->first();
        if (!isset($Gallery)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }

        $payload = $request->all();
        $file = $request->file('foto');

        if ($file) {

            $file = $request->file('foto');
            if ($file) {

                $filename = $file->hashName();
                $file->move("Gallery", $filename);
                //pembuatan url foto
                $path = $request->getSchemeAndHttpHost() . "/gallery/" . $filename;
                //end pembuatan url foto

            }
            $payload['foto'] = $path;
        }


        $Gallery->fill($payload);
        $Gallery->save();

        return response()->json([
            "status" => true,
            "message" => "perubahan data tersimpan",
            "data" => $Gallery
        ]);
    }

    function destroy($id){
        $galeri = Gallery::query()->where('id', $id)->first();
        $galeri->isdeleted = true;
        $galeri->save();
    }
}
