<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class SiswaController extends Controller
{
    public function index()
    {
        $data['title'] = "Siswa";
        $data['siswa'] = DB::select("select u.*, k.nama_kelas, j.nama_jurusan from users u left join kelas k on u.kelas_id=k.id left join jurusan j on u.jurusan_id=j.id where role = '2'");
        return view('backend.siswa.index', $data);
    }
    public function add()
    {
        $data['title'] = "Tambah Siswa";
        $data['kelas'] = DB::select("select * from kelas");
        $data['jurusan'] = DB::select("select * from jurusan");
        return view('backend.siswa.add', $data);
    }
    public function addSiswa(Request $request)
    {
        $file_path = public_path() . '/storage/images/users/' . $request->image;
        File::delete($file_path);
        $image = $request->file('image');
        $filename = $image->getClientOriginalName();
        $image->move(public_path('storage/images/users'), $filename);
        $data = [
            'nis' => $request->nis,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_tlp' => $request->no_tlp,
            'kelas_id' => $request->kelas_id,
            'jurusan_id' => $request->jurusan_id,
            'tgl_lahir' => $request->tgl_lahir,
            'no_ortu' => $request->no_ortu,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'image' => $request->file('image')->getClientOriginalName(),
            'role' => 2,
            'created_at' => now()
        ];
        // dd($data);
        $cekUsers = DB::table('users')->where('email', $request->email)->first();
        // dd($cekUsers);
        if ($cekUsers != null) {
            Alert::error('Email sudah terdaftar!');
            return redirect()->back()->withInput();
        }
        DB::table('users')->insert($data);
        Alert::success('Siswa berhasil ditambah');
        return redirect('siswa');
    }
    public function edit($id)
    {
        $data['title'] = "Edit Siswa";
        $data['siswa'] = DB::table('users')->where('id', $id)->first();
        $data['kelas'] = DB::select("select * from kelas");
        $data['jurusan'] = DB::select("select * from jurusan");
        return view('backend.siswa.edit', $data);
    }
    public function editProses(Request  $request)
    {
        if ($request->has('image') != null) {
            $getImage = DB::table('users')->where('id', $request->id)->first();
            $file_path = public_path() . '/storage/images/users/' . $getImage->image;
            File::delete($file_path);
            $image = $request->file('image');
            // dd($getImage->image);
            $filename = $image->getClientOriginalName();
            $image->move(public_path('storage/images/users'), $filename);
            $data = [
                'nis' => $request->nis,
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'no_tlp' => $request->no_tlp,
                'kelas_id' => $request->kelas_id,
                'jurusan_id' => $request->jurusan_id,
                'tgl_lahir' => $request->tgl_lahir,
                'no_ortu' => $request->no_ortu,
                'alamat' => $request->alamat,
                'image' => $request->file('image')->getClientOriginalName(),
                'role' => 2,
                'updated_at' => now()
            ];
        } else {
            $data = [
                'nis' => $request->nis,
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'no_tlp' => $request->no_tlp,
                'kelas_id' => $request->kelas_id,
                'jurusan_id' => $request->jurusan_id,
                'tgl_lahir' => $request->tgl_lahir,
                'no_ortu' => $request->no_ortu,
                'alamat' => $request->alamat,
                'role' => 2,
                'updated_at' => now()
            ];
        }

        // dd($data);
        DB::table('users')->where('id', $request->id)->update($data);
        Alert::success('Siswa berhasil diubah');
        return redirect('siswa');
    }
    public function delete($id)
    {
        try {
            // dd($id);
            $getImage = DB::table('users')->where('id', $id)->first();
            $file_path = public_path() . '/storage/images/users/' . $getImage->image;
            File::delete($file_path);
            
            DB::table('users')->where('id', $id)->delete();
            Alert::success('Siswa berhasil dihapus');
            return redirect()->route('siswa');
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
}
