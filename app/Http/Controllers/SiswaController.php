<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{   
    public function show()
    {
        $data_siswa = Siswa::join('kelas', 'kelas.id_kelas', 'siswa.id_kelas')->get();
        return Response()->json($data_siswa);
    }
    public function detail($id_siswa)
    {
        if(Siswa::where('id_siswa', $id_siswa)->exists()) {
            $data_siswa = Siswa::join('kelas', 'kelas.id_kelas', 'siswa.id_kelas')
                                    ->where('siswa.id_siswa', '=', $id_siswa)
                                    ->get();

            return Response()->json($data_siswa);
        }
        else{
            return Response()->json(['message' => 'Tidak ditemukan']);
        }
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
            'nisn' => 'required',
            'nis' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'id_kelas' => 'required',
           ]
        );

        if($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $simpan = Siswa::create([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request-> nama,
            'alamat' =>$request-> alamat,
            'no_telp' => $request-> no_telp,
            'id_kelas' => $request->id_kelas,
        ]);

        if($simpan) {
            return Response()->json(['status' => 1]);
        }
        else {
            return Response()->json(['status' => 0]);
        }
    }
    public function update($id_siswa, Request $request)
        {
            $validator=Validator::make($request->all(),
            [
                    'nisn' => 'required',
                    'nis' => 'required',
                    'nama' => 'required',
                    'alamat' => 'required',
                    'no_telp' => 'required',
                    'id_kelas' => 'required'
                ]
            );
            if($validator->fails()) {
                return Response()->json($validator->errors());
            }
                $ubah = Siswa::where('id_siswa', $id_siswa)->update([
                    'nisn' => $request->nisn,
                    'nis' => $request->nis,
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'no_telp' => $request->no_telp,
                    'id_kelas' => $request->id_kelas
            ]);
            if($ubah) {
                return Response()->json(['status' => 1]);
            }
            else {
                return Response()->json(['status' => 0]);
        }
    } 
    public function destroy($id_siswa)
    {
        $hapus = Siswa::where('id_siswa', $id_siswa)->delete();
        if($hapus){
            return Response()->json(['status' => 1]);
        }
        else{
            return Response()->json(['status' => 0]);
        }
    }
}
