<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index()
    {
        $user = User::with('role')->get()->where('isdeleted',false);

        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $user
        ]);
    }

    function show($id)
    {
        $user = User::query()->where("id", $id)->first();
        if (!isset($user)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "ini User",
            "data" => $user
        ]);
    }

    function store(Request $request)
    {
        // mengambil data dari request
        $payload = $request->all();
        // if (!isset($payload['name'])) {
        //     return response()->json([
        //         "status" => false,
        //         "message" => "input belum lengkap",
        //         "data" => null
        //     ]);
        // }
        // end ambil data dari request

        // $file = $request->file('foto');
        // if (!$file) {
        //     return response()->json([
        //         "status" => false,
        //         "message" => "input belum lengkap",
        //         "data" => null
        //     ]);
        // }
        //-------------endrevisi
        // $filename = $file->hashName();
        // $file->move("User", $filename);
        //pembuatan url foto
        // $path = $request->getSchemeAndHttpHost() . "/User/" . $filename;
        //end pembuatan url foto

        //untuk memasukan posisi foto pada storage
        // $path3 = $request->getSchemeAndHttpHost() . "User/" . $filename;
        // $path2 = str_replace($request->getSchemeAndHttpHost(), "", $path3);
        //end memasukan posisi foto pada storage
        // $payload['foto'] = $path;
        // $payload['imgurl'] = $path2;

        $user = User::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "data tersimpan",
            "data" => $user
        ]);
    }

    function update(Request $request, $id)
    {
        $user = User::query()->where("id", $id)->first();
        if (!isset($user)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }

        $payload = $request->all();

        $file = $request->file('foto');
        $temp = $user->imgurl;


        if ($file) {

            $file = $request->file('foto');
            if ($file) {

                $filename = $file->hashName();
                $file->move("User", $filename);
                //pembuatan url foto
                $path = $request->getSchemeAndHttpHost() . "/User/" . $filename;
                //end pembuatan url foto

                //untuk memasukan posisi foto pada storage
                $path3 = $request->getSchemeAndHttpHost() . "User/" . $filename;
                $path2 = str_replace($request->getSchemeAndHttpHost(), "", $path3);
                //end memasukan posisi foto pada storage

            }


            $payload['foto'] = $path;
            $payload['imgurl'] = $path2;
            unlink($temp);
        }


        $user->fill($payload);
        $user->save();

        return response()->json([
            "status" => true,
            "message" => "perubahan data tersimpan",
            "data" => $user
        ]);
    }

    function destroy(Request $request, $id)
    {
        $user = User::query()->where("id", $id)->first();

        if (!isset($user)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }


        unlink($user->imgurl);


        $user->delete();

        return response()->json([
            "status" => true,
            "message" => "Data Terhapus",
            "data" => $user
        ]);
    }
}
