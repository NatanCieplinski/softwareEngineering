<?php

namespace App\Http\Controllers;

use App\Closing;
use App\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ClosingController extends Controller
{
    private function validation(Request $request, $req=false){
        return Validator::make($request->all(),[
            'data' => $req ? 'required' : ''.'|date',
            'da_ora' => $req ? 'required' : ''.'|date_format:H:i',
            'ad_ora' => $req ? 'required' : ''.'|date_format:H:i',
            'motivazione' => $req ? 'required' : ''.'|string|max:255',
            'user_id' => $req ? 'required' : ''.'|integer|max:20',
            'classroom_id' => $req ? 'required' : ''.'|integer|max:20',
        ]);
    }

    public function create(Request $request)
    {
        if(Auth::user()->role() != "supervisor"){
            return Response::make("", 403);
        }

        $validator = $this->validation($request, true);

        if($validator->fails()){
            return Response::json($validator->messages(), 400);
        }
        $data = $validator->valid();

        $closing = Closing::create($data);

        return Response::make("", 201);
    }

    public function destroy(Request $request)
    {
        if( Auth::user()->role() == "student" ){
            return Response::make("", 403);
        }

        $closing = Closing::findOrFail($request['id']);
        Closing::destroy($request['id']);

        return Response::json($closing, 200);
    }

    public function byClassroom(Request $request)
    {
        if( Auth::user()->role() != "supervisor" && 
            Auth::user()->role() != "admin"
        ){
            return Response::make("", 403);
        }

        $classroom = Classroom::findOrFail($request['id']);

        return Response::json($classroom->closings(), 200);
    }
}
