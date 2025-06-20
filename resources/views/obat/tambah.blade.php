@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Obat</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('obat.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="nama_obat">Nama Obat</label>
            <input type="text" class="form-control" name="nama_obat" id="nama_obat" value="" required>
        </div>

        <div class="form-group mb-3">
            <label for="kategori">Kategori</label>
            <input type="text" class="form-control" name="kategori" id="kategori" value="" required>
        </div>

        <div class="form-group mb-3">
            <label for="stok">Stok</label>
            <input type="number" class="form-control" name="stok" id="stok" value="" required>
        </div>

        <div class="form-group mb-3">
            <label for="harga">Harga</label>
            <input type="number" class="form-control" name="harga" id="harga" value="" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ url('/obat') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
