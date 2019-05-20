<?php

namespace App\Http\Controllers;

use App\DiagnosticsQueue;
use App\Pacients;
use App\TrainingData;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        return view('welcome');
    }


    public function savePacient(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'code'  => 'required'
        ]);

        $pacient = Pacients::create([
            'name' => $request->name,
            'code' => $request->code,
            'sentence' => $request->sentence_filtered,
            'time' => $request->time
        ]);


        return response()->json([
            'status' => 'success',
            'pacient' => $pacient
        ]);
    }

    public function get()
    {
        return response()->json([
            'status' => 'Not supported! Use POST!'
        ]);
    }

    public function learn(Request $request)
    {
//        $data = [
//            'symptoms' => ['body ache', 'congestion', 'cough', 'fever', 'headache', 'malaise', 'runny nose', 'sneezing', 'sore throat'],
//            'disease' => 'Common Cold'
//        ];
//
//        $data = [
//            'symptoms' => ['breathing problems', 'eczema', 'hives', 'red eyes', 'runny nose', 'sneezing'],
//            'disease' => 'Allergy'
//        ];
//
//        $data = [
//            'symptoms' => ['dizziness', 'dry skin', 'headache', 'hives', 'red skin'],
//            'disease' => 'Sun Stroke'
//        ];
//
//        $data = [
//            'symptoms' => ['bleeding', 'dizziness'],
//            'disease' => 'Hemorrhage'
//        ];
//
//        $data = [
//            'symptoms' => ['malaise', 'no symptoms'],
//            'disease' => 'Hepatitis'
//        ];

        $symptoms = collect($data['symptoms']);


        $training = TrainingData::create([
            'symptoms' => $symptoms,
            'disease' => $data['disease']
        ]);


        return response()->json([
            'status' => 'success',
            'request' => $request
        ]);

    }

    public function diagnosis(Request $request)
    {
        $request->validate([
            'symptoms'  => 'required'
        ]);

//        $request->symptoms = ['malaise', 'no symptoms'];

        $queue = DiagnosticsQueue::create([
            'symptoms' => $request->symptoms,
            'disease' => null
        ]);

        return response()->json([
            'status' => 'success',
            'queue' => $queue
        ]);
    }
}
