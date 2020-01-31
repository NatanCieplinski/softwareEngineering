<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Classroom;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    private function validation(Request $request, $req=false){
        return Validator::make($request->all(),[
            'da_ora' => $req ? 'required' : ''.'|date_format:H:i:s',
            'ad_ora' => $req ? 'required' : ''.'|date_format:H:i:s',
            'posto' => $req ? 'required' : ''.'|integer|max:10',
            'user_id' => $req ? 'required' : ''.'|integer|max:20',
            'desk_id' => $req ? 'required' : ''.'|integer|max:20',
        ]);
    }

    public function checkin(Request $request)
    {
        if(Auth::user()->role() != "admin"){
            return Response::make("", 403);
        }

        $reservation = Reservation::findOrFail($request['id']);
        $reservation->checked = true;

        $reservation->save();
        return Response::make("", 204);
    }

    public function create(Request $request)
    {
        $validator = $this->validation($request, true);

        if($validator->fails()){
            return Response::json($validator->messages(), 400);
        }
        $data = $validator->valid();
        $data['data'] = date('Y-m-d', strtotime(' +1 day'));
        $data['da_ora'] = date('H:i:s', strtotime($data['da_ora']));
        $data['ad_ora'] = date('H:i:s', strtotime($data['ad_ora']));

        $reservation = Reservation::create($data);

        return Response::make("", 201);
    }

    public function pause(Request $request)
    {
        if(Auth::user()->role() != "admin"){
            return Response::make("", 403);
        }

        $reservation = Reservation::findOrFail($request['id']);
        $reservation->inizio_pausa = now();

        $reservation->save();
        return Response::make("", 204);
    }

    public function byClassroom(Request $request)
    {
        if( Auth::user()->role() != "supervisor" && 
            Auth::user()->role() != "admin"
        ){
            return Response::make("", 403);
        }

        $validator = $this->validation($request);

        if($validator->fails()){
            return Response::json($validator->messages(), 400);
        }

        $classroom = Classroom::findOrFail($request['id']);
        $data = $validator->valid();
        $date = date('Y-m-d', strtotime(' +1 day'));
        $data['da_ora'] = date('H:i:s', strtotime($data['da_ora']));
        $data['ad_ora'] = date('H:i:s', strtotime($data['ad_ora']));

        return Response::json(
            ["data" => $classroom->reservations($date, $data['da_ora'], $data['ad_ora'])]
        , 200);
    }

    public function byUser(Request $request)
    {
        if( Auth::user()->role() != "supervisor" && 
            Auth::user()->role() != "admin"
        ){
            return Response::make("", 403);
        }

        $user = User::findOrFail($request['id']);

        return Response::json($user->reservations(), 200);
    }

    public function destroy(Request $request)
    {
        if( Auth::user()->role() != "supervisor" && 
            Auth::user()->role() != "admin" &&
            Auth::user()->id != $request['id']
        ){
            return Response::make("", 403);
        }

        $reservation = Reservation::findOrFail($request['id']);
        Reservation::destroy($request['id']);

        return Response::json($reservation, 200);
    }
}
