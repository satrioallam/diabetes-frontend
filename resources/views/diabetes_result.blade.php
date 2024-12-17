@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="alert alert-info">
        <strong>Hasil Prediksi Resiko: </strong>
        <p>Resiko {{ $predictionData['risk_level'] }}</p>
    </div>

    <!-- Menampilkan hasil prediksi dengan tingkat risiko -->
    <h4>Hasil Kuesioner:</h4>
    <ul>
        <li><strong>Total Skor Diabetes:</strong> {{ number_format($predictionData['probability'] * 100, 2) }}%</li>
        <li><strong>Hasil Prediksi :</strong> {{ $predictionData['prediction'] ? "Diabetes" : "Tidak Diabetes"}}</li>
    </ul>
    
    <!-- Menampilkan data diri pengguna -->
    <h4>Data Diri Pengguna:</h4>
    <ul>
        <li><strong>Nama:</strong> {{ $user->name }}</li>
        <li><strong>Usia:</strong> {{ $user->usia }} tahun</li>
        <li><strong>Gender:</strong> {{ $user->gender == 1 ? 'Laki-Laki' : 'Perempuan' }}</li>
        <li><strong>Berat Badan:</strong> {{ $user->berat }} kg</li>
        <li><strong>Tinggi Badan:</strong> {{ $user->tinggi }} cm</li>
        <li><strong>BMI:</strong> {{ $user->bmi }}</li>
    </ul>
    <a href="{{ route('diabetes.start')  }}" class="btn btn-secondary">Selesai</a>
</div>
@endsection
<script>
    function floatToPercentage($float) {
    return ($float * 100) . '%';
}
</script>

