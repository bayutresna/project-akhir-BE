<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\ReservasiKamar;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservasiKamarController extends Controller
{
    function index()
    {
        $reservasi = ReservasiKamar::with(['user', 'kamar'])->get()->where('isdeleted',false);

        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $reservasi
        ]);
    }
    function showavailability(Request $req){
        $tanggal = $req->input('tanggal_cekin');
        $cekout = $req->input('tanggal_cekout');

        if(!$tanggal){
            return response()->json([
                "status" => false,
                "message" => "data tanggal cekin tak boleh kosong",
            ]);
        }

        if(!$cekout){
            return response()->json([
                "status" => false,
                "message" => "data tanggal cekout tak boleh kosong",
            ]);
        }

        if($cekout < $tanggal){
            return response()->json([
                "status" => false,
                "message" => "tanggal cekout tidak boleh dibawah tanggal cekin",

            ]);
        }

        $reservasi = ReservasiKamar::with(['kamar'])->where('tanggal_cekin',$tanggal)->where('tanggal_cekout','<=',$cekout)->where('isdeleted',false)->get();
        $kamar = Kamar::with(['fasilitas','tipe'])->where('isdeleted', false)->get();
        foreach($reservasi as $r){
            foreach($kamar as $k){
                if($r->id_kamar == $k->id){
                    $k->jumlah_kamar = $k->jumlah_kamar - $r->jumlah_kamar;
                }
            }
        }
        return response()->json([
            "status" => true,
            "message" => "data kamar yang tersedia",
            "data" => $kamar
        ]);
    }

    function showbyuser($id)
    {
        $reservasi = ReservasiKamar::with(['user', 'kamar'])->where("id_user", $id)->get();
        if (!isset($reservasi)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "ini ReservasiKamar",
            "data" => $reservasi
        ]);
    }
    function show($id)
    {
        $reservasi = ReservasiKamar::with(['user', 'kamar'])->where("id", $id)->first();
        if (!isset($reservasi)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "ini ReservasiKamar",
            "data" => $reservasi
        ]);
    }

    function store(Request $request)
    {

        $payload = $request->all();
        if(!$payload['tanggal_cekin']){
            return response()->json([
                "status" => false,
                "message" => "data tanggal cekin tak boleh kosong",
            ]);
        }

        if(!$payload['tanggal_cekin']){
            return response()->json([
                "status" => false,
                "message" => "data tanggal cekout tak boleh kosong",
            ]);
        }

        if($payload['tanggal_cekout'] < $payload['tanggal_cekin']){
            return response()->json([
                "status" => false,
                "message" => "tanggal cekout tidak boleh dibawah tanggal cekin",

            ]);
        }


        $kamar = Kamar::query()->where('id', $payload['id_kamar'])->first();
        // dd($kamar);



        $cekin = Carbon::parse($payload['tanggal_cekin']);
        $cekout = Carbon::parse($payload['tanggal_cekout']);
        $lama_menginap = $cekin->diffInDays($cekout);

        $payload['biaya'] = $kamar->harga * $payload['jumlah_kamar'] * $lama_menginap;
        if($payload['is_extra_bed'] == 1){
            $payload['biaya'] = $payload['biaya'] + 50000;
        }

        $reservasi = ReservasiKamar::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "data tersimpan",
            "data" => $reservasi
        ]);
    }

    function update(Request $request, $id)
    {
        $reservasi = ReservasiKamar::query()->where("id", $id)->first();
        if (!isset($reservasi)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }

        $payload = $request->all();

        $file = $request->file('bukti_pembayaran');

        if(!$file){
            $reservasi->fill($payload);
            $reservasi->save();

            return response()->json([
                "status" => true,
                "message" => "perubahan data tersimpan",
                "data" => $reservasi
            ]);
        }

        $filename = $file->hashName();
        $file->move("ReservasiKamar", $filename);

        //pembuatan url foto
        $path = $request->getSchemeAndHttpHost() . "/ReservasiKamar/" . $filename;
        //end pembuatan url foto

        //untuk memasukan posisi foto pada storage
        //end memasukan posisi foto pada storage
        $payload['bukti_pembayaran'] = $path;


        $reservasi->fill($payload);
        $reservasi->save();

        return response()->json([
            "status" => true,
            "message" => "perubahan data tersimpan",
            "data" => $reservasi
        ]);
    }

    function destroy(Request $request, $id)
    {
        $reservasi = ReservasiKamar::query()->where("id", $id)->first();

        if (!isset($reservasi)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }


        $reservasi->isdeleted= true;

        return response()->json([
            "status" => true,
            "message" => "Data Terhapus",
            "data" => $reservasi
        ]);
    }
}
