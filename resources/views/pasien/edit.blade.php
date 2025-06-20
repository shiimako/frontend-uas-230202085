@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pasien</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pasien.update', $pasien['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="nama">Nama Pasien</label>
            <input type="text" class="form-control" name="nama" id="nama" value="{{ $pasien['nama'] }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" name="alamat" id="alamat" value="{{ $pasien['alamat'] }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ $pasien['tanggal_lahir'] }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="L" {{ $pasien['jenis_kelamin'] == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ $pasien['jenis_kelamin'] == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ url('/pasien') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
