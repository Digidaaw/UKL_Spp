<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spp;
use Illuminate\Support\Facades\Validator;

class SppController extends Controller
{
    public function show()
    {
        return Spp::all();
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'angkatan' => 'required',
            'tahun' => 'required',
            'nominal' => 'required'
        ]);

        if($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $simpan = Spp::create([
            'angkatan' => $request-> angkatan,
            'tahun' =>$request-> tahun,
            'nominal' => $request-> nominal
        ]);

        if($simpan) {
            return Response()->json(['status' => 1]);
        }
        else {
            return Response()->json(['status' => 0]);
        }
    }
    public function update($id_spp, Request $request)
        {
            $validator=Validator::make($request->all(),
            [
                    'angkatan' => 'required',
                    'tahun' => 'required',
                    'nominal' => 'required'
                ]
            );
            if($validator->fails()) {
                return Response()->json($validator->errors());
            }
                $ubah = Spp::where('id_spp', $id_spp)->update([
                    'angkatan' => $request->angkatan,
                    'tahun' => $request->tahun,
                    'nominal' => $request->nominal
            ]);
            if($ubah) {
                return Response()->json(['status' => 1]);
            }
            else {
                return Response()->json(['status' => 0]);
        }
    }
    public function destroy($id_spp)
    {
        $hapus = Spp::where('id_spp', $id_spp)->delete();
        if($hapus){
            return Response()->json(['status' => 1]);
        }
        else{
            return Response()->json(['status' => 0]);
        }
    }
}
