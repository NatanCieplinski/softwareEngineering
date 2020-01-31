<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    private function validation(Request $request, $req=false){
        return Validator::make($request->all(),[
            'data' => $req ? 'required' : ''.'|date',
            'da_ora' => $req ? 'required' : ''.'|date_format:H:i',
            'ad_ora' => $req ? 'required' : ''.'|date_format:H:i',
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

        $classroom = Classroom::findOrFail($request['id']);

        return Response::json($classroom->reservations(), 200);
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
