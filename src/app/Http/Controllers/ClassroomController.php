<?php

namespace App\Http\Controllers;

use App\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\GeometryCollection;

class ClassroomController extends Controller
{
    private function validation(Request $request, $req=false){
        return Validator::make($request->all(),[
            'nome' => $req ? 'required' : ''.'string|max:255',
            'rumorosita' => 'integer|max:10',
            'frequenza_ble' => 'integer|max:10',
            'righe' => $req ? 'required' : ''.'integer|max:10',
            'colonne' => $req ? 'required' : ''.'integer|max:10',
            'map_id' => $req ? 'required' : ''.'integer|max:20',
            //'disegno' => $req ? 'required' : ''.'array',            
        ]);
    }

    public function all(){
        return Response::json(Classroom::paginate(), 200);
    }

    public function create(Request $request){
        if(Auth::user()->role() != "admin"){
            return Response::make("", 403);
        }

        $validator = $this->validation($request, true);

        if($validator->fails()){
            return Response::json($validator->messages(), 400);
        }
        $data = $validator->valid();
        $data['disegno'] = new GeometryCollection([new Point(1,4), new Point(4,1), new Point(5,8), new Point(2,8)]);

        $classroom = Classroom::create($data);

        return Response::make("", 201);
    }

    public function show(Request $request){
        $classroom = Classroom::findOrFail($request['id']);
        return Response::json($classroom, 200);
    }

    public function update(Request $request){
        if(Auth::user()->role() != "admin"){
            return Response::make("", 403);
        }

        $validator = $this->validation($request);

        if($validator->fails()){
            return Response::json($validator->messages(), 400);
        }

        $classroom = Classroom::findOrFail($request['id']);

        $data = $validator->valid();

        if(isset($data['nome']))
            $classroom->nome = $data['nome'];
        if(isset($data['rumorosita']))
            $classroom->rumorosita = $data['rumorosita'];
        if(isset($data['frequenza_ble']))
            $classroom->frequenza_ble = $data['frequenza_ble'];
        if(isset($data['righe']))
            $classroom->righe = $data['righe'];
        if(isset($data['colonne']))
            $classroom->colonne = $data['colonne'];
        //if(isset($data['disegno']))
        //    $classroom->disegno = $data['disegno'];
        if(isset($data['map_id']))
            $classroom->map_id = $data['map_id'];

        $classroom->save();
        return Response::make("", 204);
    }

    public function destroy(Request $request){
        if(Auth::user()->role() != "admin"){
            return Response::make("", 403);
        }

        $classroom = Classroom::findOrFail($request['id']);
        Classroom::destroy($request['id']);

        return Response::json($classroom, 200);
    }
}
