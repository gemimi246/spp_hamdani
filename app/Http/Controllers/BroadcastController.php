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

            // $response = Http::post('https://wa.dlhcode.com/send-message?api_key=hZdj1cXOBd9kKEln6dIhE0SOhrUtg9sa&sender=6289636337580&number=' . $no . '&message=' . $request->pesan . '');
            // dd($response);
            $data = [
                'api_key' => "hZdj1cXOBd9kKEln6dIhE0SOhrUtg9sa",
                'sender' => "6289636337580",
                'number' =>   $no ,
                'message' =>  $request->message 
            ];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://wa.dlhcode.com/send-message",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
        }
        echo json_encode($response);
    }
}
