<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranController extends Controller
{
    //

    public function view()
    {
        $data['title'] = "Pembayaran";
        $data['getSiswa'] = DB::select("select * from users where role = '2'");
        $data['thajaran'] = DB::select("select * from tahun_ajaran where active = 'ON'");
        $data['kelas'] = DB::select("select * from kelas");
        $data['siswa'] = "";
        $data['pembayaran_bulanan'] = "";
        $data['pembayaran_lainya '] = "";
        return view('backend.pembayaran.view', $data);
    }
    public function search(Request $request)
    {
        $data['title'] = "Pembayaran";
        $data['getSiswa'] = DB::select("select * from users where role = '2'");
        $data['thajaran'] = DB::select("select * from tahun_ajaran where active = 'ON'");
        $data['kelas'] = DB::select("select * from kelas");


        // dd($request->all());
        $data['siswa'] = DB::table('users')->join('tagihan', 'users.id', '=', 'tagihan.user_id')->join('kelas', 'kelas.id', '=', 'tagihan.kelas_id')->where('users.id', $request->user_id)->where('users.kelas_id', $request->kelas_id)->first();
        $data['pembayaran_bulanan'] = DB::select("select t.*, u.nama_lengkap, ta.tahun, jp.pembayaran, u.nis from tagihan t left join users u on t.user_id=u.id left join tahun_ajaran ta on ta.id=t.thajaran_id left join jenis_pembayaran jp on jp.id=t.jenis_pembayaran where u.id = '$request->user_id' and u.kelas_id = '$request->kelas_id' and t.jenis_pembayaran = '1'");
        $data['pembayaran_lainya'] = DB::select("select t.*, u.nama_lengkap, ta.tahun, jp.pembayaran, u.nis from tagihan t left join users u on t.user_id=u.id left join tahun_ajaran ta on ta.id=t.thajaran_id left join jenis_pembayaran jp on jp.id=t.jenis_pembayaran where u.id = '$request->user_id' and u.kelas_id = '$request->kelas_id' and t.jenis_pembayaran != '1'");
        if ($data['pembayaran_bulanan'] == null) {
            Alert::warning('Peringatan', 'SISWA BELUM ADA TAGIHAN');
            return view('backend.pembayaran.view', $data);
        } else {
            return view('backend.pembayaran.view', $data);
        }
    }
        // dd($data['siswa']);
        
    public function spp($id_tagihan)
    {
        $data['title'] = "Spp";
        // $data['id_tagihan'] = $id_tagihan;

        $getDataUser[0] = DB::select("select user_id, thajaran_id, t.kelas_id from tagihan t left join users u on t.user_id=u.id where t.id = '$id_tagihan'");
        $data['user_id'] = $getDataUser[0][0]->user_id;
        $data['thajaran_id'] = $getDataUser[0][0]->thajaran_id;
        $data['kelas_id'] = $getDataUser[0][0]->kelas_id;
        $data['tagihan_id'] = $id_tagihan;
        $data['spp'] = DB::select("select s.*, u.nama_lengkap, ta.tahun, jp.pembayaran, b.nama_bulan from payment s left join users u on u.id=s.user_id left join bulan b on b.id=s.bulan_id left join tagihan t on t.id=s.tagihan_id left join tahun_ajaran ta on ta.id=t.thajaran_id left join jenis_pembayaran jp on jp.id=t.jenis_pembayaran where t.id = '$id_tagihan'");
        $data['bulan'] = DB::select("SELECT id, nama_bulan FROM bulan WHERE id NOT IN (SELECT bulan_id FROM payment WHERE tagihan_id = '$id_tagihan')");
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
                'kelas_id' => $request->kelas_id,
                'nilai' => $request->getNilai,
                'order_id' => $dataMidtrans->order_id,
                'pdf_url' => $dataMidtrans->pdf_url,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status' => "Belum Bayar",
                'created_at' => now(),
            ];
        }
        // dd($data);
        DB::table('payment')->insert($data);
        return redirect("/pembayaran/spp/$request->tagihan_id");
    }
    public function payment($id_tagihan)
    {
        $data['title'] = "Payment";
        $data['payment'] = DB::select("SELECT t.*, u.nama_lengkap, jp.pembayaran, ta.tahun FROM tagihan t LEFT JOIN users u on u.id=t.user_id LEFT JOIN jenis_pembayaran jp on jp.id=t.jenis_pembayaran LEFT JOIN tahun_ajaran ta on ta.id=t.thajaran_id WHERE t.id = '$id_tagihan'");
        // dd($data['spp']);
        return view('backend.pembayaran.payment', $data);
    }
}
