<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TunggakanController extends Controller
{
    public function view()
    {
        $data['title'] = "Tunggakan";
        $data['siswa'] = DB::select("select * from users where role = '2'");

        return view('backend.tunggakan.view', $data);
    }

    public function load_data(Request $request)
    {
        // dd($request->)
        // $and = "";

        $data = DB::select("SELECT z.*, z.tagihan - z.bayar AS tunggakan FROM (
  SELECT t.user_id, u.nama_lengkap, ta.tahun, jp.pembayaran,
  CASE
    WHEN t.jenis_pembayaran = 1 THEN t.nilai * 12
    ELSE t.nilai
    END AS tagihan, SUM(IFNULL(p.nilai, 0)) AS bayar
  FROM tagihan t
  LEFT JOIN payment p on p.tagihan_id=t.id
  LEFT JOIN tahun_ajaran ta on ta.id=t.thajaran_id
  LEFT JOIN jenis_pembayaran jp on jp.id=t.jenis_pembayaran
  INNER JOIN users u on u.id = t.user_id
  GROUP BY t.user_id, jp.pembayaran, ta.tahun, t.jenis_pembayaran, t.nilai
) z
WHERE z.user_id = '$request->user_id' ORDER BY tunggakan DESC");
        // dd($data);
        echo json_encode($data);
    }
}
