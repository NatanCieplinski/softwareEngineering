<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\Classroom;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    private function validation(Request $request, $req=false){
        return Validator::make($request->all(),[
            'data' => $req ? 'required' : ''.'|date',
            'da_ora' => $req ? 'required' : ''.'|date_format:H:i',
            'ad_ora' => $req ? 'required' : ''.'|date_format:H:i',
            'user_id' => $req ? 'required' : ''.'|integer|max:20',
            'classroom_id' => $req ? 'required' : ''.'|integer|max:20',
        ]);
    }

    public function create(Request $request)
    {
        if(Auth::user()->role() != "professor"){
            return Response::make("", 403);
        }

        $validator = $this->validation($request, true);

        if($validator->fails()){
            return Response::json($validator->messages(), 400);
        }
        $data = $validator->valid();

        $schedule = Schedule::create($data);

        return Response::make("", 201);
    }

    public function destroy(Request $request)
    {
        if( Auth::user()->role() != "supervisor" && 
            Auth::user()->role() != "admin" &&
            Auth::user()->id != $request['id']
        ){
            return Response::make("", 403);
        }

        $schedule = Schedule::findOrFail($request['id']);
        Schedule::destroy($request['id']);

        return Response::json($schedule, 200);
    }

    public function byUser(Request $request)
    {
        if( Auth::user()->role() != "supervisor" && 
            Auth::user()->role() != "admin"
        ){
            return Response::make("", 403);
        }

        $user = User::findOrFail($request['id']);

        return Response::json($user->schedules(), 200);
    }

    public function byClassroom(Request $request)
    {
        if( Auth::user()->role() != "supervisor" && 
            Auth::user()->role() != "admin"
        ){
            return Response::make("", 403);
        }

        $classroom = Classroom::findOrFail($request['id']);

        return Response::json($classroom->schedules(), 200);
    }
}
