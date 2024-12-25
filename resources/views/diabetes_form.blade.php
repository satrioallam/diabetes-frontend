@extends('form')

@section('content')
<div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-6 col-md-8 col-12">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header bg-gradient text-black text-center py-5">
                    <h3>Kuesioner Deteksi Diabetes</h3>
                    <p class="lead">Silakan jawab pertanyaan berikut untuk mengetahui risiko diabetes Anda.</p>
                </div>
                <div class="card-body p-5">
                    {{-- <div class="text-end mb-4">
                        <button type="button" class="btn btn-secondary" onclick="randomizeAnswers()">
                            Isi Random
                        </button>
                    </div> --}}
                    <form action="{{ route('diabetes.saveAnswer', $user_id) }}" method="POST">
                        @csrf
                        @foreach($questions as $index => $question)
                            <div class="form-group mb-4">
                                <label class="form-label h5 text-muted">{{ $question->question_text }}</label>
                                {{-- Cek kategori dari scale untuk menentukan tipe input --}}
                                @if($question->scale_category == 'general')
                                    <div class="d-flex justify-content-between mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                                   id="yes_{{ $question->id }}"
                                                   name="answers[{{ $question->id }}]" 
                                                   value="1" required>
                                            <label class="form-check-label text-primary">Ya</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                                   id="no_{{ $question->id }}"
                                                   name="answers[{{ $question->id }}]" 
                                                   value="0" required>
                                            <label class="form-check-label text-danger">Tidak</label>
                                        </div>
                                    </div>
                                @elseif($question->scale_category == 'kesehatan')
                                    <div class="mt-3">
                                        <select class="form-control" 
                                                id="health_{{ $question->id }}"
                                                name="answers[{{ $question->id }}]" required>
                                            <option>Pilihan</option>
                                            <option value="1">Sangat Baik</option>
                                            <option value="2">Baik</option>
                                            <option value="3">Cukup</option>
                                            <option value="4">Buruk</option>
                                            <option value="5">Sangat Buruk</option>
                                        </select>
                                    </div>
                                @endif
                                @if($question->scale_category == 'kesehatan_mental')
                                    <div class="mt-3">
                                        <input type="number" class="form-control" 
                                               id="mental_{{ $question->id }}"
                                               name="answers[{{ $question->id }}]" 
                                               min="1" max="30" required>
                                    </div>
                                @endif
                                @if($question->scale_category == 'pendapatan')
                                <div class="mt-3">
                                    <select class="form-control" 
                                            id="income_{{ $question->id }}"
                                            name="answers[{{ $question->id }}]" required>
                                        <option>Pilihan</option>
                                        <option value="1"> < Rp 1.000.000</option>
                                        <option value="2">Rp 1.000.000 - < Rp 2.000.000</option>
                                        <option value="3">Rp 2.000.000 - < Rp 3.000.000</option>
                                        <option value="4">Rp 3.000.000 - < Rp 4.000.000</option>
                                        <option value="5">Rp 4.000.000 - < Rp 5.000.000</option>
                                        <option value="6">Rp 5.000.000 - < Rp 6.000.000</option>
                                        <option value="7">Rp 6.000.000 - < Rp 7.000.000</option>
                                        <option value="8">> Rp 7.000.000</option>
                                    </select>
                                </div>
                                @endif
                            </div>
                        @endforeach
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg w-100 py-2 shadow-sm mt-4">
                                Lihat Hasil
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function randomizeAnswers() {
    // Get all questions
    const questions = document.querySelectorAll('.form-group');
    
    questions.forEach(question => {
        // Get the question's category from the input elements
        if (question.querySelector('input[type="radio"]')) {
            // General yes/no questions
            const randomValue = Math.random() < 0.5 ? '1' : '0';
            const radioInput = question.querySelector(`input[value="${randomValue}"]`);
            if (radioInput) radioInput.checked = true;
        }
        
        else if (question.querySelector('select')) {
            const select = question.querySelector('select');
            const options = select.querySelectorAll('option');
            const validOptions = Array.from(options).slice(1); // Remove the "Pilihan" option
            
            if (select.id.startsWith('health_')) {
                // Health questions (1-5)
                const randomIndex = Math.floor(Math.random() * 5) + 1;
                select.value = randomIndex;
            }
            else if (select.id.startsWith('income_')) {
                // Income questions (1-8)
                const randomIndex = Math.floor(Math.random() * 8) + 1;
                select.value = randomIndex;
            }
        }
        
        else if (question.querySelector('input[type="number"]')) {
            // Mental health questions (1-30)
            const input = question.querySelector('input[type="number"]');
            const randomValue = Math.floor(Math.random() * 30) + 1;
            input.value = randomValue;
        }
    });
}
</script>
@endsection