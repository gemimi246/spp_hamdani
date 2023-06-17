<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class BroadcastController extends Controller
{
    public function view()
    {
        $data['title'] = "Broadcast";
        $data['siswa'] = DB::select("select no_tlp, nama_lengkap from users where role = '2'");
        return view('backend.broadcast.view', $data);
    }
    function sendMessage(Request $request)
    {
        // dd($request->all());
        foreach ($request->nomor as $no) {

            $response = Http::get('https://wa.dlhcode.com/send-message?api_key=hZdj1cXOBd9kKEln6dIhE0SOhrUtg9sa&sender=6289636337580&number=' . $no . '&message=' . $request->pesan . '');
            
        }
        echo json_encode($response);
    }
}
