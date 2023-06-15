<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data['rankpayment'] = DB::select("SELECT u.nama_lengkap, p.user_id, k.nama_kelas, u.alamat,  SUM(p.nilai) as total 
        FROM payment p LEFT JOIN users u on u.id=p.user_id LEFT JOIN kelas k on k.id=p.kelas_id 
        WHERE p.status = 'Lunas' GROUP BY p.user_id, u.nama_lengkap, p.user_id, k.nama_kelas, u.alamat ORDER BY total DESC LIMIT 7");
        if (request()->user()->role != 1) {
            $data['totalById'] = DB::table('payment')->where('user_id', request()->user()->id)->sum('nilai');
        } else {
            $data['totalById'] = DB::table('payment')->sum('nilai');
        }

        $data['totalBulanan'] = request()->user()->role != 1 ?
        DB::table('payment')->where('user_id', request()->user()->id)->where('bulan_id', '!=', null)->where('status', 'Lunas')->sum('nilai') :
        DB::table('payment')->where('bulan_id', '!=', null)->where('status', 'Lunas')->sum('nilai');
        $data['totalLainya'] = request()->user()->role != 1 ?
        DB::table('payment')->where('user_id', request()->user()->id)->where('bulan_id', '=', null)->where('status', 'Lunas')->sum('nilai') :
        DB::table('payment')->where('bulan_id', '=', null)->where('status', 'Lunas')->sum('nilai');

        // dd($data['totalById']);
        return view('backend.dashboard.index', $data);
    }
}
