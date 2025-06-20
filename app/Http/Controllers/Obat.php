<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class Obat extends Controller
{
    public function getallobat()
    {
        $response = Http::get('http://localhost:8080/obat');

        if ($response->successful()) {
            $data = $response->json();
            return view('obat.view', ['obat' => $data['data_obat']]);
        }

        return redirect('/')->withErrors(['gagal' => 'Gagal ambil data obat']);
    }

    public function getobatbyid($id)
    {
        $response = Http::get('http://localhost:8080/obat/'. $id);

        if ($response->successful()) {
            $data = $response->json();
            return view('obat.edit', ['obat' => $data['data_obat']]);
        }

        return redirect('/obat')->withErrors(['gagal' => 'Gagal ambil data obat']);
    }

    public function saveobat(Request $request)
    {
        $cek = Http::get('http://localhost:8080/obat/'); 
        if ($cek->successful()) {
            $data = $cek->json();
            foreach ($data['data_obat'] as $value) {
                if ($value['nama_obat'] == $request->nama_obat) {
                    return redirect('/obat/tambah')->withInput()->withErrors(['gagal' => 'Obat sudah ada']);
                }
            }
        }

        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0'
        ]);

        $response = Http::post('http://localhost:8080/obat', [
                "nama_obat" => $request->nama_obat,
                "kategori" => $request->kategori,
                "stok" => $request->stok,
                "harga" => $request->harga
            ]);

        if ($response->successful()) {
            return redirect('/obat');
        }

        return redirect('/obat')->withErrors(['gagal' => 'Gagal Menambahkan data obat']);
    }

    public function updateobat(Request $request, $id)
    {
        $cek = Http::get('http://localhost:8080/obat/');

        if ($cek->successful()) {
            $data = $cek->json();
            foreach ($data['data_obat'] as $value) {
                if ($value['nama_obat'] == $request->nama_obat) {
                    return redirect('/obat/edit/' . $id)->withInput()->withErrors(['gagal' => 'Obat sudah ada']);
                }
            }
        }

        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0'
        ]);

        $response = Http::put(
                'http://localhost:8080/obat/' . $id,
                [
                "nama_obat" => $request->nama_obat,
                "kategori" => $request->kategori,
                "stok" => $request->stok,
                "harga" => $request->harga
                ]
            );

        if ($response->successful()) {
            return redirect('/obat');
        }

        return redirect('/obat')->withErrors(['gagal' => 'Gagal Mengupdate data obat']);
    }

    public function deleteobat($id)
    {
        $response = Http::delete('http://localhost:8080/obat/' . $id);

        if ($response->successful()) {
            return redirect('/obat');
        }

        return redirect('/obat')->withErrors(['gagal' => 'Gagal Menghapus data obat']);
    }
}