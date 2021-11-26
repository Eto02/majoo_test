<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return view('kategori.index');
    }
    public function getKategori(Request $request)
    {

        $kategori =  Kategori::get();

        if (count($kategori) <= 0) {
            $data['data'] = [];
            $data['total'] = 0;
        } elseif (count($kategori) > 0) {
            $data['data'] = $kategori;
            $data['total'] = count($kategori);
        }
        return json_encode($data);
    }
    public function storeKategori(Request $request)
    {
        try {
            $insert = Kategori::insert($request->all());

            $data['message'] = 'Selamat anda berhasil menambahkan kategori';
            $data['code'] = 1;
            return json_encode($data);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            $data['code'] = 0;
            return json_encode($data);
        }
    }
    public function updateKategori(Request $request)
    {
        try {
            $update = Kategori::where('Id_Kategori', $request->Id_Kategori)->update($request->all());

            $data['message'] = 'Selamat anda berhasil merubah kategori';
            $data['code'] = 1;
            return json_encode($data);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            $data['code'] = 0;
            return json_encode($data);
        }
    }
    public function deleteKategori(Request $request)
    {
        try {

            $delete = Kategori::where('Id_Kategori', $request->Id_Kategori)->delete();

            $data['message'] = 'Selamat anda berhasil menghapus kategori';
            $data['code'] = 1;
            return json_encode($data);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            $data['code'] = 0;
            return json_encode($data);
        }
    }
}
