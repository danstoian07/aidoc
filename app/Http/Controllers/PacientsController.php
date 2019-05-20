<?php

namespace App\Http\Controllers;

use App\Pacients;
use App\Symptom;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PacientsController extends Controller
{
    public function pacient(Request $request)
    {
        $request->validate([
            'code'  => 'required'
        ]);

        $pacient = Pacients::where('code', $request->code)->first();

        if(! $pacient) {
            $pacient = new Pacients();
            $pacient->name = 'Not Found !';
        }
        else {

            //minutes
            $now = Carbon::now();
            $pacient_time = Carbon::createFromFormat('H:i', $pacient->time);
            $minutes = $now->diffInMinutes($pacient_time, false);
            if($minutes < 0) {
                $minutes = 0;
            }

            //symptoms
            $pacient_words = explode(' ', $pacient->sentence);

            if (strpos($pacient->sentence, 'blood in urine') !== false) {
                array_push($pacient_words, 'blood_in_urine');
            }
            if (strpos($pacient->sentence, 'body ache') !== false) {
                array_push($pacient_words, 'body_ache');
            }
            if (strpos($pacient->sentence, 'breathing problems') !== false) {
                array_push($pacient_words, 'breathing_problems');
            }
            if (strpos($pacient->sentence, 'dry skin') !== false) {
                array_push($pacient_words, 'dry_skin');
            }
            if (strpos($pacient->sentence, 'no symptoms') !== false) {
                array_push($pacient_words, 'no_symptoms');
            }
            if (strpos($pacient->sentence, 'painful urination') !== false) {
                array_push($pacient_words, 'painful_urination');
            }
            if (strpos($pacient->sentence, 'red eyes') !== false) {
                array_push($pacient_words, 'red_eyes');
            }
            if (strpos($pacient->sentence, 'red skin') !== false) {
                array_push($pacient_words, 'red_skin');
            }
            if (strpos($pacient->sentence, 'runny nose') !== false) {
                array_push($pacient_words, 'runny_nose');
            }
            if (strpos($pacient->sentence, 'sore throat') !== false) {
                array_push($pacient_words, 'sore_throat');
            }
            if (strpos($pacient->sentence, 'yellow skin') !== false) {
                array_push($pacient_words, 'yellow_skin');
            }

            $pacient_symptoms = collect();
            foreach ($pacient_words as $word) {
                $match = Symptom::where('name', $word)->first();
                if($match) {
                    $pacient_symptoms->push($word);
                }
            }

//            $test_data = collect();
//            foreach ($pacient_symptoms as $symptom) {
//                $test_data->push($symptom);
//            }

            $test_data = array_fill_keys($pacient_symptoms->toArray(), true);



        }

        return view('welcome', compact('pacient', 'minutes', 'pacient_symptoms', 'test_data'));
    }
}
