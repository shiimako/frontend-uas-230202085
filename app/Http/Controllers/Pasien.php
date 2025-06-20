<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Pasien extends Controller
{
    public function getallpasien()
    {
        $response = Http::get('http://localhost:8080/pasien');

        if ($response->successful()) {
            $data = $response->json();
            return view('pasien.view', ['pasien' => $data['data_pasien']]);
        }

        return redirect('/')->withErrors(['gagal' => 'Gagal ambil data pasien']);
    }

    public function getpasienbyid($id)
    {
        $response = Http::get('http://localhost:8080/pasien/' . $id);

        if ($response->successful()) {
            $data = $response->json();
            return view('pasien.edit', ['pasien' => $data['data_pasien']]);
        }

        return redirect('/pasien')->withErrors(['gagal' => 'Gagal ambil data pasien']);
    }

    public function savepasien(Request $request)
    {
        $cek = Http::get('http://localhost:8080/pasien/');

        if ($cek->successful()) {
            $data = $cek->json();
        }
        foreach ($data['data_pasien'] ?? [] as $value) {
            if ($value['nama'] == $request->nama) {
                return redirect('/pasien/tambah')->withInput()->withErrors(['gagal' => 'Pasien sudah ada']);
            }
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan'
        ]);

        $response = Http::post('http://localhost:8080/pasien', [
            "nama" => $request->nama,
            "alamat" => $request->alamat,
            "tanggal_lahir" => $request->tanggal_lahir,
            "jenis_kelamin" => $request->jenis_kelamin
        ]);

        if ($response->successful()) {
            return redirect('/pasien');
        }

        return redirect('/pasien')->withErrors(['gagal' => 'Gagal Menambahkan data pasien']);
    }

    public function updatepasien(Request $request, $id)
    {
        $cek = Http::get('http://localhost:8080/pasien/');
        if ($cek->successful()) {
            $data = $cek->json();
        }

        foreach ($data['data_pasien'] ?? [] as $value) {
            if ($value['nama'] == $request->nama && $value['id'] != $id) {
                return redirect('/pasien/edit/' . $id)->withInput()->withErrors(['gagal' => 'Pasien sudah ada']);
            }
        }
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan'
        ]);
        $response = Http::put(
            'http://localhost:8080/pasien/' . $id,
            [
                "nama" => $request->nama,
                "alamat" => $request->alamat,
                "tanggal_lahir" => $request->tanggal_lahir,
                "jenis_kelamin" => $request->jenis_kelamin
            ]
        );

        if ($response->successful()) {
            return redirect('/pasien');
        }

        return redirect('/pasien')->withErrors(['gagal' => 'Gagal Mengupdate data pasien']);
    }

    public function deletepasien($id)
    {
        $response = Http::delete('http://localhost:8080/pasien/' . $id);

        if ($response->successful()) {
            return redirect('/pasien');
        }

        return redirect('/pasien')->withErrors(['gagal' => 'Gagal Menghapus data dosen']);
    }
}
