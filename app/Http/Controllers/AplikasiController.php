<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use RealRashid\SweetAlert\Facades\Alert;

class AplikasiController extends Controller
{

    // public function view()
    // {
    //     $data['title'] = "Aplikasi";
    //     $data['aplikasi'] = DB::table('aplikasi')->first();

    //     return view('backend.aplikasi.edit', $data);
    // }
    public function view()
    {
        // dd("asd");
        //ENTER THE RELEVANT INFO BELOW
        $mysqlHostName      = env('DB_HOST');
        $mysqlUserName      = env('DB_USERNAME');
        $mysqlPassword      = env('DB_PASSWORD');
        $DbName             = env('DB_DATABASE');
        $backup_name        = "mybackup.sql";
        $tables             = array("users", "messages", "posts"); //here your tables...

        $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword", array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $result = $statement->fetchAll();


        $output = '';
        foreach ($tables as $table) {
            $show_table_query = "SHOW CREATE TABLE " . $table . "";
            $statement = $connect->prepare($show_table_query);
            $statement->execute();
            $show_table_result = $statement->fetchAll();

            foreach ($show_table_result as $show_table_row) {
                $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
            }
            $select_query = "SELECT * FROM " . $table . "";
            $statement = $connect->prepare($select_query);
            $statement->execute();
            $total_row = $statement->rowCount();

            for ($count = 0; $count < $total_row; $count++) {
                $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
                $table_column_array = array_keys($single_result);
                $table_value_array = array_values($single_result);
                $output .= "\nINSERT INTO $table (";
                $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
                $output .= "'" . implode("','", $table_value_array) . "');\n";
            }
        }
        $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_name));
        ob_clean();
        flush();
        readfile($file_name);
        unlink($file_name);
    }
    public function editProses(Request  $request)
    {
        try {
            if ($request->has('image') != null) {
                $file_path = public_path() . '/storage/images/logo/' . $request->image;
                File::delete($file_path);
                $image = $request->file('image');
                $filename = $image->getClientOriginalName();
                $image->move(public_path('storage/images/logo'), $filename);
                $data = [
                    'title' => $request->title,
                    'nama_owner' => $request->nama_owner,
                    'alamat' => $request->alamat,
                    'tlp' => $request->tlp,
                    'nama_aplikasi' => $request->nama_aplikasi,
                    'copy_right' => $request->copy_right,
                    'versi' => $request->versi,
                    'token_whatsapp' => $request->token_whatsapp,
                    'serverKey' => $request->serverKey,
                    'clientKey' => $request->clientKey,
                    'logo' => $request->file('image')->getClientOriginalName(),
                ];
            } else {
                $data = [
                    'title' => $request->title,
                    'nama_owner' => $request->nama_owner,
                    'alamat' => $request->alamat,
                    'tlp' => $request->tlp,
                    'nama_aplikasi' => $request->nama_aplikasi,
                    'copy_right' => $request->copy_right,
                    'versi' => $request->versi,
                    'token_whatsapp' => $request->token_whatsapp,
                    'serverKey' => $request->serverKey,
                    'clientKey' => $request->clientKey,
                ];
            }
            DB::table('aplikasi')->where('id', $request->id)->update($data);
            Alert::success('Aplikasi Sukses diupdate!');
            return redirect()->route('aplikasi');
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
    
}
