<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return response([ 
            'status' => 'success',
             'data' =>  $users
            ],200);
    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if(!$user) {

            return response([ 
                'status' => 'fail',
                 'data' =>  'no data found '
                ],404);
        }else{

            return response([ 
                'status' => 'success',
                 'data' =>  $user
                ],200);

        }
    }

   


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $user = User::find($id);

        if($user) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'email' => 'required|email|unique:users,email,'.$id.'|max:255',
                'user_name' => 'required|string|unique:users,user_name,'.$id.'|max:25',
                'phone_number' => 'required|string|unique:users,phone_number,'.$id.'|max:25',
                'password' => 'required|min:10',
                
            ]);
            // Return errors if validation error occur.
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response([ 
                    'status' => 'fail',
                    'data' =>  $errors
                    ]);
            }
            // Check if validation pass then create user and auth token. Return the auth token
            if ($validator->passes()) {
                
                $user = $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'user_name' => $request->user_name,
                    'phone_number' => $request->phone_number,
                    'date_of_birth' => $request->date_of_birth,
                    'password' => Hash::make($request->password)
                ]);
            
                return response([ 
                    'status' => 'success',
                    'data' =>  $user
                    ],202);
            }

        }else {

            return response([ 
                'status' => 'fail',
                 'data' =>  'not found '
                ],404);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::find($id);

        if(!$user) {

            return response([ 
                'status' => 'fail',
                 'data' =>  'not found '
                ],404);

        }else {

            $user->delete();

            return response([ 
                'status' => 'success',
                 'data' =>  'success delete'
                ]);
        }
        
    }
}
