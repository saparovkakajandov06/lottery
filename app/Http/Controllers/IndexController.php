<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\IpAdd;
use App\Models\Winner;
class IndexController extends Controller
{
    const STARTDATE = '04.02.2023';
    const PROBABILITY = 5; // chances are 5/1


    public function main(Request $request)
        {
            return view('mailBox.inbox');
        }   

    public function try(Request $request)
        {
            if(!is_null(IpAdd::where('ipadd', $request->ip())->first())){
                return response()->json([
                    'message' => "i am sorry...",
                ], 200);

            }else{
                IpAdd::create([
                    'ipaddress' => $request->ip(),
                ]);
                $todays_winner = Winner::whereDate('created_at', Carbon::today())->first();
                if(!is_null($todays_winner)){
                    return response()->json([
                        'message' => "i am sorry...",
                        'res' => 'res',

                    ], 200);
                }else{
                    $diffInDays = Carbon::now()->diffInDays($this::STARTDATE);
        
                    if ($diffInDays < 7){
                        $r = random_int(0, $this::PROBABILITY); // generates random int between 0 and PROBABILITY
                        if ($r == 1) { // chance of getting 1 is 5/1
                            Winner::create([
                                'date' => today(),
                                'ipaddress' => $request->ip(),
                            ]);
                            return response()->json([
                                'message' => "Conguratulation" 
                            ]);
        
                        }
                    }
                    return response()->json([
                        'message' => "i am sorry...",
                    ], 200);
                }
            }

        }   
}
