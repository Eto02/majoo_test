<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        return view('produk.index');
    }
    public function getProduk(Request $request)
    {

        $prduk =  Produk::get();

        if (count($prduk) <= 0) {
            $data['data'] = [];
            $data['total'] = 0;
        } elseif (count($prduk) > 0) {
            $data['data'] = $prduk;
            $data['total'] = count($prduk);
        }
        return json_encode($data);
    }
    public function storeProduk(Request $request)
    {

        $main_path = 'public/upload/foto';

        try {
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                // $name =  $request->file('foto')->getClientOriginalName();
                $data = [
                    // 'Created_By' => Auth::user()->name,
                    'Created_Date' => date('Y-m-d'),
                    // 'Foto_Produk' => $main_path . "/" . $name,
                    'Nama_Produk' => $request->nama,
                    'Harga_Produk' => $request->harga,
                    'Deskripsi_Produk' => $request->deskirpsi,
                ];


                $insert = Produk::insertGetId($data);
                if ($insert) {
                    $image->move(storage_path('app/' . $main_path), $insert);
                    $insert = Produk::where('Id_Produk', $insert)
                        ->update([
                            'Foto_Produk' => $main_path . "/" . $insert
                        ]);
                }
            }

            $data['message'] = 'Selamat anda berhasil menambahkan produk';
            $data['code'] = 1;
            return json_encode($data);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            $data['code'] = 0;
            return json_encode($data);
        }
    }
    public function updateProduk(Request $request)
    {
        try {
            $update = Produk::where('Id_Produk', $request->Id_Produk)->update($request->all());

            $data['message'] = 'Selamat anda berhasil merubah produk';
            $data['code'] = 1;
            return json_encode($data);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            $data['code'] = 0;
            return json_encode($data);
        }
    }
    public function deleteProduk(Request $request)
    {
        try {

            $delete = Produk::where('Id_Produk', $request->Id_Produk)->delete();

            $data['message'] = 'Selamat anda berhasil menghapus produk';
            $data['code'] = 1;
            return json_encode($data);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            $data['code'] = 0;
            return json_encode($data);
        }
    }
}
