<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProblemSolvingController extends Controller
{
    public function getIndexOfString( Request $request){

        $validator = Validator::make( $request->all(),
            [
                'input_string' => 'required'
            ]
        ) ;

        if($validator->passes()){

            $result = 0;
            $str =strtoupper($request->input_string);
            $array = str_split($str);
            for ($i = 0; $i < strlen($str); $i++)
            {
                $result *= 26;
                $result += mb_ord($array[$i], "utf8") - mb_ord('A', "utf8") + 1;
            }
            return $result;
        }

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response([ 
                'status' => 'fail',
                'data' =>  $errors
                ]);
        }

        
    }
   
   
   
   
    public function getCountOfNumbers( Request $request){

        $start = 0;
        $end = 0 ;

        $validator = Validator::make( $request->all(),
        [
            'start_number' => 'required|integer',
            'end_number' => 'required|integer'
        ]) ;

        $start = $request->start_number ;
        $end = $request->end_number ;

        if($validator->passes()){

            $result = $end - $start + 1 ;

            if(($end > 5 & $start > 5) || ( $end < 5 & $start < 5)){
               
                return $result ;

            }else{

                return $result -1  ;

            }
        }

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response([ 
                'status' => 'fail',
                'data' =>  $errors
                ]);
        }


        
    }

    public function getMinimumNumberOfMoves() {

        $N = 5;
        $Q = [14,8,123,40,50];

        $array = [];

        for($i=0;$i<$N;$i++){

            $counter = 0;
            while($Q[$i]>0){
                if($Q[$i]%2==0){
                    $Q[$i] = $Q[$i]/2;
                    $counter++;
                }else{
                    $Q[$i]--;
                    $counter++;
                }
            }
            array_push($array , $counter);
        }

        return $array ;

    }
}
