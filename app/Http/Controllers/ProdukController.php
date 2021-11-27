<?php

namespace App\Http\Controllers;

use App\Produk;
use App\ProdukKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        return view('produk.index');
    }
    public function getProduk(Request $request)
    {
        $perPage = ($request->exists('perPage') ? $request->perPage : 5);
        $curentPage = ($request->exists('currentPage') ? $request->currentPage : 1);
        $prduk =  Produk::with('produkKategoris.mstrKategori')->skip(($curentPage - 1) * $perPage)->take($perPage)->get();
        $totalItem=Produk::get();
        if($request->exists('search')){
            $prduk =  Produk::with('produkKategoris.mstrKategori')->where('Nama_Produk','like','%'.$request->search.'%')->skip(($curentPage - 1) * $perPage)->take($perPage)->get();
            $totalItem= Produk::with('produkKategoris.mstrKategori')->where('Nama_Produk','like','%'.$request->search.'%')->get();
        }
        if (count($prduk) <= 0) {
            $data['data'] = [];
            $data['total'] = 0;
        } elseif (count($prduk) > 0) {
            $data['data'] = $prduk;
            $data['total'] = count($totalItem);
            $data['perPage'] = $perPage;
            $data['currentPage'] = $curentPage;
        }
        return json_encode($data);
    }
    public function storeProduk(Request $request)
    {

        $credentials = $request->validate([
            'nama' => ['required'],
            'harga' => ['required'],
            'foto' => ['required'],
            'deskirpsi' => ['required'],
            'kategori' => ['required'],
        ]);
        // dd($credentials);
        $main_path = 'public/upload/foto';
        $cekProduk=Produk::where('Nama_Produk',$request->nama)->first();
        if (!is_null($cekProduk)) {
            $data['message'] = 'Nama produk sudah ada';
            $data['code'] = 1;
            return response($data,200);
        }
        try {
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $extension = '.' . $request->file('foto')->clientExtension();
                $isi = [
                    // 'Created_By' => Auth::user()->name,
                    'Created_Date' => date('Y-m-d'),
                    // 'Foto_Produk' => $main_path . "/" . $name,
                    'Nama_Produk' => $request->nama,
                    'Harga_Produk' => $request->harga,
                    'Deskripsi_Produk' => $request->deskirpsi,
                ];


                $insert = Produk::insertGetId($isi);
                if ($insert) {
                    if ($request->kategori) {
                        // dd(json_decode( $request->kategori));
                        foreach (json_decode($request->kategori) as $key) {
                            ProdukKategori::insert([
                                'Id_Produk' => $insert,
                                'Id_Kategori' => $key
                            ]);
                        }
                    }

                    $image->move(storage_path('app/' . $main_path), $insert . $extension);
                    $insert = Produk::where('Id_Produk', $insert)
                        ->update([
                            'Foto_Produk' => $main_path . "/" . $insert . $extension
                        ]);
                }
            }

            $data['message'] = 'Selamat anda berhasil menambahkan produk';
            $data['code'] = 1;
            return response($data,200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            $data['code'] = 0;
            return response($data,200);
        }
    }
    public function updateProduk(Request $request)
    {
        $main_path = 'public/upload/foto';

        try {
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $extension = '.' . $request->file('foto')->clientExtension();
                $name = $request->id_produk . $extension;



                Storage::delete('public/upload/foto/' . $name);
                $image->move(storage_path('app/' . $main_path), $name);
                $update = Produk::where('Id_Produk', $request->id_produk)
                    ->update([
                        'Foto_Produk' => $main_path . "/" . $name
                    ]);
            }
            $data = [
                // 'Created_By' => Auth::user()->name,
                // 'Created_Date' => date('Y-m-d'),
                'Nama_Produk' => $request->nama,
                'Harga_Produk' => $request->harga,
                'Deskripsi_Produk' => $request->deskirpsi,
            ];
            $cekNama=Produk::where('Id_Produk', $request->id_produk)->first();
            $cekProduk=Produk::where('Nama_Produk',$request->nama)->count();
            if ($cekNama->Nama_Prodak!=$request->nama && $cekProduk>0) {
                $data['message'] = 'Nama produk sudah ada';
                $data['code'] = 1;
                return response($data,200);
            }
            $update = Produk::where('Id_Produk', $request->id_produk)->update($data);
            if ($update) {
                if ($request->kategori) {
                    $delete =  ProdukKategori::where('Id_Produk', $request->id_produk)->delete();

                    foreach (json_decode($request->kategori) as $key) {
                        ProdukKategori::insert([
                            'Id_Produk' => $request->id_produk,
                            'Id_Kategori' => $key
                        ]);
                    }
                }
            }


            $data['message'] = 'Selamat anda berhasil merubah produk';
            $data['code'] = 1;
            return response($data,200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            $data['code'] = 0;
            return response($data,200);
            }
    }
    public function deleteProduk(Request $request)
    {
        try {

            Storage::delete('public/upload/foto/' . $request->id_produk);
            ProdukKategori::where('Id_Produk', $request->Id_Produk)->delete();
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
