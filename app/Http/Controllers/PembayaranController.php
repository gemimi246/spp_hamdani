<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    //

    public function view()
    {
        $data['title'] = "Pembayaran";
        $data['getSiswa'] = DB::select("select * from users where role = '2'");
        $data['thajaran'] = DB::select("select * from tahun_ajaran where active = 'ON'");
        $data['siswa'] = "";
        $data['pembayaran_bulanan'] = "";
        return view('backend.pembayaran.view', $data);
    }
    public function search(Request $request)
    {
        $data['title'] = "Pembayaran";
        $data['getSiswa'] = DB::select("select * from users where role = '2'");
        $data['thajaran'] = DB::select("select * from tahun_ajaran where active = 'ON'");
        $data['siswa'] = DB::select("select * from tagihan t left join users u on u.id=t.user_id where t.thajaran_id = '$request->thajaran_id' and u.id = '$request->user_id'");
        $data['pembayaran_bulanan'] = DB::select("select t.*, u.nama_lengkap, ta.tahun, jp.pembayaran, u.nis from tagihan t left join users u on t.user_id=u.id left join tahun_ajaran ta on ta.id=t.thajaran_id left join jenis_pembayaran jp on jp.id=t.jenis_pembayaran where t.thajaran_id = '$request->thajaran_id' and u.id = '$request->user_id'");
        // dd($data['siswa']);
        return view('backend.pembayaran.view', $data);
    }
    public function spp($id_tagihan)
    {
        $data['title'] = "Spp";
        // $data['id_tagihan'] = $id_tagihan;

        $getDataUser[0] = DB::select("select user_id, thajaran_id from tagihan t left join users u on t.user_id=u.id where t.id = '$id_tagihan'");
        $data['user_id'] = $getDataUser[0][0]->user_id;
        $data['thajaran_id'] = $getDataUser[0][0]->thajaran_id;
        $data['tagihan_id'] = $id_tagihan;
        // dd($data['tagihan_id']);
        $data['spp'] = DB::select("select s.*, u.nama_lengkap, ta.tahun, jp.pembayaran, b.nama_bulan from spp s left join users u on u.id=s.user_id left join bulan b on b.id=s.bulan_id left join tagihan t on t.id=s.tagihan_id left join tahun_ajaran ta on ta.id=t.thajaran_id left join jenis_pembayaran jp on jp.id=t.jenis_pembayaran where t.id = '$id_tagihan'");

        $data['bulan'] = DB::select("select * from bulan");
        $data['getNilai'] = DB::select("select nilai from tagihan where id = '$id_tagihan'")[0]->nilai;

        // dd($data['getNilai']);
        return view('backend.pembayaran.spp', $data);
    }
    public function sppAddProses(Request $request)
    {
        $dataMidtrans = json_decode($request->result_data);
        // dd($dataMidtrans);
        foreach ($request->bulan as $key => $bu) {
            $data[] = [
                'bulan_id' => $bu,
                'user_id' => request()->user()->id,
                'tagihan_id' => $request->tagihan_id,
                'nilai' => $request->getNilai,
                'order_id' => $dataMidtrans->order_id,
                'pdf_url' => $dataMidtrans->pdf_url,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status' => "Belum Bayar",
                'created_at' => now(),
            ];
        }
        // dd($data);
        DB::table('spp')->insert($data);
        return redirect("/pembayaran/spp/$request->tagihan_id");
    }
}
