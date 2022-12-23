@extends('layouts.master')
@section('title', 'Create Menu')
@section('content')
    <h2>Tambahkan Menu Baru!</h2>
    <form action="{{ route('menus.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8 mb-3">
                <label for="nama">Nama Makanan</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama"
                    value="{{ old('nama') }}">
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="id">Jenis Makanan</label>
                <select class="form-control @error('id') is-invalid @enderror" name="id" id="id">
                    <option value="none" disabled selected>Pilih Jenis Makanan</option>
                    <option value="makan" {{ old('id') == 'makan' ? 'selected' : '' }}>Makanan</option>
                    <option value="minum" {{ old('id') == 'minum' ? 'selected' : '' }}>Minuman</option>
                    <option value="snack" {{ old('id') == 'snack' ? 'selected' : '' }}>Snack</option>
                </select>
                @error('id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="harga">Harga</label>
                <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga"
                    id="harga" value="{{ old('harga') }}" min="0">
                @error('harga')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 mb-3">
                <input type="hidden" name="rekomendasi" id="rekomendasi" value="0">
                <label for="rekomendasi">Rekomendasi</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 mb-3">
                <input type="checkbox" class="form-check-input form-control @error('rekomendasi') is-invalid @enderror"
                    name="rekomendasi" id="rekomendasi" value="1" {{ old('rekomendasi') == 'true' ? 'checked' : '' }}>
                @error('rekomendasi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 mb-5">

            </div>
        </div>
        <div class="row">
            <div class="col-md-2 mb-3">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Tambah Menu</button>
            </div>
        </div>

    </form>
@endsection
