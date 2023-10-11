<?php
///SAMPE UPDATE
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembayaran;
use Illuminate\Support\Facades\Validator;

class PembayaranController extends Controller
{
    public function show()
    {
        $data_pembayaran = Pembayaran::join('siswa', 'siswa.id_siswa', 'pembayaran.id_siswa')->get();
        return Response()->json($data_pembayaran);

        $data_pembayaran = Pembayaran::join('petugas', 'petugas.id_petugas', 'pembayaran.id_petugas')->get();
        return Response()->json($data_pembayaran);
    }
    public function detail($id_pembayaran)
    {
        if(Pembayaran::where('id_pembayaran', $id_pembayaran)->exists()) {
            $data_pembayaran = Pembayaran::join('siswa', 'siswa.id_siswa', 'pembayaran.id_siswa')
                                    ->where('pembayaran.id_pembayaran', '=', $id_pembayaran)
                                    ->get();

            $data_pembayaran = Pembayaran::join('petugas', 'petugas.id_petugas', 'pembayaran.id_petugas')
                                    ->where('pembayaran.id_pembayaran', '=', $id_pembayaran)
                                    ->get();

            return Response()->json($data_pembayaran);
        }
        else{
            return Response()->json(['message' => 'Tidak ditemukan']);
        }
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'id_petugas' => 'required',
            'id_siswa' => 'required',
            'tgl_bayar' => 'required',
            'bulan_spp' => 'required',
            'tahun_spp' => 'required'
        ]);

        if($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $simpan = Pembayaran::create([
            'id_petugas' => $request-> id_petugas,
            'id_siswa' =>$request-> id_siswa,
            'tgl_bayar' => date("Y-m-d"),
            'bulan_spp' => $request-> bulan_spp,
            'tahun_spp' => $request-> tahun_spp
        ]);

        if($simpan) {
            return Response()->json(['status' => 1]);
        }
        else {
            return Response()->json(['status' => 0]);
        }
    }
    public function update($id_pembayaran, Request $request)
        {
            $validator=Validator::make($request->all(),
            [
                    'id_petugas' => 'required',
                    'id_siswa' => 'required',
                    'tgl_bayar' => 'required',
                    'bulan_spp' => 'required',
                    'tahun_spp' => 'required'
                ]
            );
            if($validator->fails()) {
                return Response()->json($validator->errors());
            }
                $ubah = Pembayaran::where('id_pembayaran', $id_pembayaran)->update([
                    'id_petugas' => $request->id_petugas,
                    'id_siswa' => $request->id_siswa,
                    'tgl_bayar' => daye("Y-m-d"),
                    'bulan_spp' => $request->bulan_spp,
                    'tahun_spp' => $request->tahun_spp
            ]);
            if($ubah) {
                return Response()->json(['status' => 1]);
            }
            else {
                return Response()->json(['status' => 0]);
        }
    }
    public function destroy($id_pembayaran)
    {
        $hapus = Pembayaran::where('id_pembayaran', $id_pembayaran)->delete();
        if($hapus){
            return Response()->json(['status' => 1]);
        }
        else{
            return Response()->json(['status' => 0]);
        }
    }
}


