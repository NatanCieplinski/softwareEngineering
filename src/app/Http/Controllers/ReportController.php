<?php

namespace App\Http\Controllers;

use App\Report;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    private function validation(Request $request, $req=false){
        return Validator::make($request->all(),[
            'motivazione' => $req ? 'required' : ''.'|string|max:255',
            'user_id' => $req ? 'required' : ''.'|integer|max:20',
        ]);
    }

    public function create(Request $request)
    {
        if( Auth::user()->role() != "supervisor" && 
            Auth::user()->role() != "admin"
        ){
            return Response::make("", 403);
        }

        $validator = $this->validation($request, true);

        if($validator->fails()){
            return Response::json($validator->messages(), 400);
        }
        $data = $validator->valid();
        $data['admin_id'] = Auth::user()->id;

        $report = Report::create($data);

        return Response::make("", 201);
    }

    public function show(Request $request)
    {
        if( Auth::user()->role() != "supervisor" && 
            Auth::user()->role() != "admin"
        ){
            return Response::make("", 403);
        }

        $report = Report::findOrFail($request['id']);
        return Response::json($report, 200);
    }

    public function update(Request $request)
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

        $report = Report::findOrFail($request['id']);

        $data = $validator->valid();

        if(isset($data['nome']))
            $report->nome = $data['nome'];

        $report->save();
        return Response::make("", 204);
    }

    public function destroy(Request $request)
    {
        if( Auth::user()->role() != "supervisor" && 
            Auth::user()->role() != "admin"
        ){
            return Response::make("", 403);
        }

        $report = Report::findOrFail($request['id']);
        Report::destroy($request['id']);

        return Response::json($report, 200);
    }
    
    public function byUser(Request $request)
    {
        if( Auth::user()->role() != "supervisor" && 
            Auth::user()->role() != "admin"
        ){
            return Response::make("", 403);
        }

        $user = User::findOrFail($request['id']);

        return Response::json($user->reports(), 200);
    }
}
