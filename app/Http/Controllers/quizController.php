<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class quizController extends Controller
{
    public function saveAnswers(Request $request){
        try{
            $validatedData = $request->validate([
                'vote' => 'required|numeric|min:1|max:4',
            ]);

            $vote=DB::table('ratings')->insert([
                'vote'=>$validatedData['vote'],
            ]);

            if($vote){
                return response()->json([
                    'status' => 'success',
                    'message'=>'Thank you for your rating.'
                ]);
            }

        }catch (\Exception $e){
            Log::error(__CLASS__ ." :: ".__FUNCTION__ ." :: ".$e->getMessage());
            return response()->json([
                'status' => 'failed',
                'message'=>'Something wrong.',
                'Error' => $e->getMessage()
            ]);
        }
    }

    public function getResults(Request $request){
        try {
            $query=DB::table('ratings');
            $count=$query->count();
            $votes=$query
                ->select('vote',DB::raw("count(vote) as no_of_voters"),DB::raw('ROUND((count(vote)/'.$count.")*100) as percent"))
                ->groupBy('vote')
                ->get();

            return response()->json([
                'status' => 'success',
                'data' => $votes
            ]);
        }catch (\Exception $e){
            Log::error(__CLASS__ ." :: ".__FUNCTION__ ." :: ".$e->getMessage());
            return response()->json([
                'status' => 'failed',
                'data'=>[],
                'Error' => $e->getMessage()
            ]);
        }
    }
}
