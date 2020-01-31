<?php

namespace App\Http\Controllers;

use App\Desk;
use App\Classroom;
use App\Desktype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class DeskController extends Controller
{
    private function validation(Request $request, $req=false){
        return Validator::make($request->all(),[
            'orientamento' => $req ? 'required' : ''.'|integer|max:1',
            'x_pos' => $req ? 'required' : ''.'|array|size:2',
            'y_pos' => $req ? 'required' : ''.'|array|size:2',
            'classroom_id' => $req ? 'required' : ''.'|integer',
            'desktype_id' => $req ? 'required' : ''.'|integer',
        ]);
    }
 
    public function all(Request $request)
    {
        return Response::json(Desk::paginate(), 200);
    }

    public function create(Request $request)
    {
        if(Auth::user()->role() != "admin"){
            return Response::make("", 403);
        }

        $validator = $this->validation($request, true);

        if($validator->fails()){
            return Response::json($validator->messages(), 400);
        }
        $data = $validator->valid();
        $data['x_pos'] = new Point($data['x_pos'][0], $data['x_pos'][1]);
        $data['y_pos'] = new Point($data['y_pos'][0], $data['y_pos'][1]);

        $desk = Desk::create($data);

        return Response::make("", 201);
    }

    public function show(Request $request)
    {
        $desk = Desk::findOrFail($request['id']);
        return Response::json($desk, 200);
    }

    public function update(Request $request)
    {
        if(Auth::user()->role() != "admin"){
            return Response::make("", 403);
        }
        
        $validator = $this->validation($request);

        if($validator->fails()){
            return Response::json($validator->messages(), 400);
        }

        $desk = Desk::findOrFail($request['id']);

        $data = $validator->valid();

        if(isset($data['orientamento']))
            $desk->orientamento = $data['orientamento'];
        if(isset($data['x_pos']))
            $desk->x_pos = new Point($data['x_pos'][0], $data['x_pos'][1]);
        if(isset($data['y_pos']))
            $desk->y_pos = new Point($data['y_pos'][0], $data['y_pos'][1]);
        if(isset($data['classroom_id']))
            $desk->classroom_id = $data['classroom_id'];
        if(isset($data['desktype_id']))
            $desk->desktype_id = $data['desktype_id'];

        $desk->save();
        return Response::make("", 204);
    }

    public function destroy(Request $request)
    {
        if(Auth::user()->role() != "admin"){
            return Response::make("", 403);
        }

        $desk = Desk::findOrFail($request['id']);
        Desk::destroy($request['id']);

        return Response::json($desk, 200);
    }

    public function byClassroom(Request $request)
    {
        if( Auth::user()->role() != "supervisor" && 
            Auth::user()->role() != "admin"
        ){
            return Response::make("", 403);
        }

        $classroom = Classroom::findOrFail($request['id']);
        
        $desks = $classroom->desks();
        foreach($desks as $i => $desk){
            $desk->tipo_banco = Desktype::findOrFail($desk->desktype_id);
            $desks[$i] = $desk;
        }

        return Response::json($desks, 200);
    }
}
