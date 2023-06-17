<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function view()
    {
        $data['title'] = "Kelas";
        $data['kelas'] = DB::select("select * from kelas");
        return view('backend.kelas.view', $data);
    }
    
    public function add()
    {
        $data['title'] = "Tambah kelas";
        return view('backend.kelas.add', $data);
    }
    public function addkelas(Request $request)
    {
        $data = [
            'nama_kelas' => $request->nama_kelas,
            'keterangan' => $request->keterangan,
            'created_at' => now()
        ];
        // dd($data);
        DB::table('kelas')->insert($data);
        return redirect('kelas');
    }
    public function edit(Request $request)
    {
        $data['title'] = "Edit Kelas";
        $data['kelas'] = DB::table('kelas')->where('id', $request->id)->first();
        return view('backend.kelas.edit', $data);
    }
    public function editProses(Request $request)
    {
        $data = [
            'nama_kelas' => $request->nama_kelas,
            'keterangan' => $request->keterangan,
            'updated_at' => now()
        ];

        // dd($request->id);
        DB::table('kelas')->where('id', $request->id)->update($data);
        return redirect('kelas');
    }
    public function delete($id)
    {
        try {
            // dd($id);
            DB::table('kelas')->where('id', $id)->delete();
            // Alert::success('Category was successful deleted!');
            return redirect()->route('kelas');
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
    public function movekelas()
    {
        $data['title'] = "Naik Kelas";
        
        $data['kelas'] = DB::select("select * from kelas");
        $data['jurusan'] = DB::select("select * from jurusan");
        return view('backend.kelas.movekelas', $data);
    }
    public function load_data_moveKelas(Request $request)
    {
        // dd($request->)
        // $and = "";

        $data = DB::select("select u.id, u.nama_lengkap, k.nama_kelas, j.nama_jurusan from users u left join kelas k on k.id=u.kelas_id left join jurusan j on j.id=u.jurusan_id where u.kelas_id = '$request->kelas_id_from' and u.jurusan_id = '$request->jurusan_id_from'");
        // dd($data);
        echo json_encode($data);
    }
    function moveproses(Request $request) {
        // dd($request->all());
    }
}
