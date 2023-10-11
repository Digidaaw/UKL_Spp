<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Petugas;
use Illuminate\Support\Facades\Validator;

class PetugasController extends Controller
{
    public function show()
    {
        return Petugas::all();
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'username' => 'required',
            'password' => 'required',
            'nama_petugas' => 'required',
            'level' => 'required'
        ]);

        if($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $simpan = Petugas::create([
            'username' => $request-> username,
            'password' =>$request-> password,
            'nama_petugas' => $request-> nama_petugas,
            'level' => $request-> level
        ]);

        if($simpan) {
            return Response()->json(['status' => 1]);
        }
        else {
            return Response()->json(['status' => 0]);
        }
    }
    public function update($id_petugas, Request $request)
        {
            $validator=Validator::make($request->all(),
            [
                    'username' => 'required',
                    'password' => 'required',
                    'nama_petugas' => 'required',
                    'level' => 'required',
                ]
            );
            if($validator->fails()) {
                return Response()->json($validator->errors());
            }
                $ubah = Petugas::where('id_petugas', $id_petugas)->update([
                    'username' => $request->username,
                    'password' => $request->password,
                    'nama_petugas' => $request->nama_petugas,
                    'level' => $request->level,
            ]);
            if($ubah) {
                return Response()->json(['status' => 1]);
            }
            else {
                return Response()->json(['status' => 0]);
        }
    }
    public function destroy($id_petugas)
    {
        $hapus = Petugas::where('id_petugas', $id_petugas)->delete();
        if($hapus){
            return Response()->json(['status' => 1]);
        }
        else{
            return Response()->json(['status' => 0]);
        }
    }
}
