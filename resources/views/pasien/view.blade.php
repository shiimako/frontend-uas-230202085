<!-- resources/views/obat/view.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Obat</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <a href="{{ route('pasien.create') }}" class="btn btn-primary mb-3">+ Tambah Pasien</a>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nama Pasien</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pasien as $index  => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['alamat'] }}</td>
                    <td>{{ $item['tanggal_lahir'] }}</td>
                    <td>{{ $item['jenis_kelamin'] }}</td>
                    <td>
                        <a href="{{ url('/pasien/edit/' . $item['id']) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ url('/pasien/delete/' . $item['id']) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data pasien.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
