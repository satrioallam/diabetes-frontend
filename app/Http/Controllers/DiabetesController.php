<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Scale;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Result;
use Exception;
use Illuminate\Support\Facades\Http;

class DiabetesController extends Controller
{
    // Menampilkan form data diri
    public function showIntro()
    {
        return view('user_form');
    }

    // Menyimpan data pengguna ke database
    public function saveUserData(Request $request)
    {
        // Validasi data pengguna
        $validated = $request->validate([
            // 'id' => 'required|integer', 
            'name' => 'required|string|max:100',
            'usia' => 'required|integer|min:1|max:120',
            'gender' => 'required|in:1,0', // 1 untuk laki-laki, 0 untuk perempuan
            'pendidikan' => 'required|integer',
            'tinggi' => 'required|numeric|min:50|max:250',
            'berat' => 'required|numeric|min:10|max:200',
            'asal' => 'required|string|max:100',
        ]);

        // Hitung BMI
        $tinggiMeter = $validated['tinggi'] / 100; // Konversi tinggi ke meter
        $bmi = $validated['berat'] / ($tinggiMeter * $tinggiMeter);
        $bmi = round($bmi, 2); // Membulatkan hasil BMI ke 2 angka desimal

        // Simpan data pengguna ke database
        $user = new User();
        //  $user->id = $validated['id'];
        $user->name = $validated['name'];
        $user->usia = $validated['usia'];
        $user->usia_scale_id = $this->getScaleId('usia', $validated['usia']);
        $user->gender = $validated['gender']; //(1 untuk laki-laki, 0 untuk perempuan)
        $user->gender_scale_id = $this->getScaleId('gender', $validated['gender']);
        $user->pendidikan_scale_id = $validated['pendidikan'];
        $user->tinggi = $validated['tinggi'];
        $user->berat = $validated['berat'];
        $user->bmi = $bmi;
        $user->asal = $validated['asal'];
        $user->save();

        return redirect()->route('diabetes.questionnaire', ['user_id' => $user->id]);
    }

    // Menampilkan kuesioner berdasarkan user_id
    public function showQuestionnaire($user_id)
    {
        // Mengambil data pengguna berdasarkan user_id
        $user = User::findOrFail($user_id);

        // Mengambil semua pertanyaan dari database
        $questions = Question::with('scale')->get();

        return view('diabetes_form', compact('questions', 'user_id'));
    }

    // Menyimpan jawaban kuesioner dan menghitung hasilnya
    public function saveAnswers(Request $request, $user_id)
    {
        // Validasi jawaban kuesioner
        foreach ($request->answers as $question_id => $answer_value) {
            Answer::create([
                'user_id' => $user_id,
                'question_id' => $question_id,
                'answer_value' => $answer_value,
            ]);
        }
        $totalScore = 10;

        // Menentukan level risiko berdasarkan total skor
        $riskLevel = $this->calculateRiskLevel($totalScore);


        // Simpan hasil ke database
        // Result::create([
        //     'user_id' => $user_id,
        //     'probability' => $totalScore,
        //     'risk_level' => $riskLevel,
        //     'prediction' => 1,
        // ]);


        return redirect()->route('diabetes.result', ['user_id' => $user_id]);
    }

    public function showResult($user_id)
    {
        $user = User::findOrFail($user_id);
        $result = Result::where('user_id', $user_id)->first();

        // If the result exists, load it and return the view
        if ($result) {
            $predictionData = $result;
            return view('diabetes_result', compact('user', 'predictionData'));
        }

        // Initialize predictionData to null or a default error state
        $predictionData = null;
        $error = null;

        // If the result doesn't exist, proceed with API call and result creation
        $answers = Answer::where('user_id', $user_id)->get();

        // Collect user-specific features
        $data = [
            'Education' => $user->pendidikan_scale_id, // Education level
            'Age' => $user->usia_scale_id,            // Age category
            'Sex' => $user->gender,                   // Gender
            'BMI' => floatval($user->bmi),            // BMI (convert to float)
        ];

        // Mapping of question_id to feature names
        $featureMapping = [
            1 => 'Smoker',
            2 => 'HvyAlcoholConsump',
            3 => 'HighBP',
            4 => 'HighChol',
            5 => 'Stroke',
            6 => 'CholCheck',
            7 => 'HeartDiseaseorAttack',
            8 => 'NoDocbcCost',
            9 => 'AnyHealthcare',
            10 => 'PhysActivity',
            11 => 'DiffWalk',
            12 => 'Fruits',
            13 => 'Veggies',
            14 => 'GenHlth',
            15 => 'Income',
            16 => 'MentHlth',
            17 => 'PhysHlth',
        ];

        // Collect answer-based features
        foreach ($featureMapping as $question_id => $feature) {
            $answer = $answers->where('question_id', $question_id)->first();
            if ($answer) {
                $data[$feature] = $answer->answer_value;
            } else {
                $data[$feature] = 0; // Default value for missing answers
            }
        }
        // return $answers;

        // Make a POST request to the Python API
        try {
            $response = Http::post('http://127.0.0.1:1337/predict', $data);
            $response->throw();

            $predictionData = $response->json();
          //  return $predictionData;
            $totalScore = $predictionData["probability"];
            $riskLevel = $predictionData["risk_level"];
            $prediction = $predictionData["prediction"];
          //  return $predictionData;
            // Create the result in the database
            Result::create([
                'user_id' => $user_id,
                'probability' => $totalScore,
                'risk_level' => $riskLevel,
                'prediction' => $prediction,
            ]);

            // Pass the prediction data to the view
            return view('diabetes_result', compact('user', 'result', 'predictionData'));
        } catch (Exception $e) {
            // Handle the exception
            $error = $e->getMessage();
            // You can also set specific error details in predictionData if needed
            $predictionData = [
                'error' => true,
                'message' => 'An error occurred while processing the prediction.',
                'details' => $error // Optional: Include detailed error for debugging
            ];
            // Since the result wasn't saved due to the error, don't try to pass $result.
            return view('diabetes_result', compact('user', 'predictionData'));
        }
    }

    // Fungsi untuk mendapatkan scale ID dari tabel scales berdasarkan kategori dan nilai
    private function getScaleId($category, $value)
    {
        return Scale::where('category', $category)
            ->where('value', '<=', $value)
            ->orderBy('value', 'desc')
            ->value('id');
    }

    // Fungsi untuk menentukan level risiko berdasarkan total skor
    private function calculateRiskLevel($score)
    {
        if ($score >= 8) return 'Resiko Tinggi';
        if ($score >= 4) return 'Resiko Sedang';
        return 'Resiko Rendah';
    }
}