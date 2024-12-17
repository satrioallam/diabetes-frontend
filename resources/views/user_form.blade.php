@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-12">
        <div class="form-container">
            <div class="card-header text-center">
                <h3>Data Diri Pengguna</h3>
                <p class="lead">Silakan isi data diri Anda untuk melanjutkan ke kuesioner deteksi diabetes.</p>
            </div>
            <div class="card-body">
                <form action="{{ route('diabetes.saveUserData') }}" method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="usia" class="form-label">Usia</label>
                        <input type="number" class="form-control" id="usia" name="usia" placeholder="Masukkan Usia" value="{{ old('usia') }}" required min="1" max="120">
                    </div>

                    <div class="form-group mb-4">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option>Pilihan</option>
                            <option value="0" {{ old('gender') == '0' ? 'selected' : '' }}>Perempuan</option>
                            <option value="1" {{ old('gender') == '1' ? 'selected' : '' }}>Laki-Laki</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="pendidikan" class="form-label">Pendidikan Terakhir</label>
                        <select class="form-control" id="pendidikan" name="pendidikan" required>
                            <option>Pilihan</option>
                            <option value="1" {{ old('pendidikan') == '1' ? 'selected' : '' }}>Tidak Sekolah</option>
                            <option value="2" {{ old('pendidikan') == '2' ? 'selected' : '' }}>SD</option>
                            <option value="3" {{ old('pendidikan') == '3' ? 'selected' : '' }}>SMP</option>
                            <option value="4" {{ old('pendidikan') == '4' ? 'selected' : '' }}>SMA</option>
                            <option value="5" {{ old('pendidikan') == '5' ? 'selected' : '' }}>Diploma</option>
                            <option value="6" {{ old('pendidikan') == '6' ? 'selected' : '' }}>Sarjana</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="tinggi" class="form-label">Tinggi Badan (cm)</label>
                        <input type="number" class="form-control" id="tinggi" name="tinggi" placeholder="Masukkan Tinggi Badan" value="{{ old('tinggi') }}" required min="50" max="250">
                    </div>

                    <div class="form-group mb-4">
                        <label for="berat" class="form-label">Berat Badan (kg)</label>
                        <input type="number" class="form-control" id="berat" name="berat" placeholder="Masukkan Berat Badan" value="{{ old('berat') }}" required min="10" max="200">
                    </div>

                    <div class="form-group mb-4">
                        <label for="asal" class="form-label">Asal</label>
                        <input type="text" class="form-control" id="asal" name="asal" placeholder="Masukkan Asal" value="{{ old('asal') }}" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-100">Lanjutkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
