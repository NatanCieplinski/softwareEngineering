<?php

namespace App\Http\Controllers;

use App\Desktype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\GeometryCollection;

class DesktypeController extends Controller
{
    private function validation(Request $request, $req=false){
        return Validator::make($request->all(),[
            'nome' => $req ? 'required' : ''.'|string|max:255',
            'numero_posti' => $req ? 'required' : ''.'|string|max:255',
            //'disegno' => $req ? 'required' : ''.'|array',
        ]);
    }
 
    public function all(Request $request)
    {
        // Da definire ruoli?
        return Response::json(Desktype::paginate(), 200);
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
        // Hardcoded per semplicita'
        $data['disegno'] = new GeometryCollection([new Point(1,4), new Point(4,1), new Point(5,8), new Point(2,8)]);

        $desktype = Desktype::create($data);

        return Response::make("", 201);
    }

    public function show(Request $request)
    {
        $desktype = Desktype::findOrFail($request['id']);
        return Response::json($desktype, 200);
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

        $desktype = Desktype::findOrFail($request['id']);

        $data = $validator->valid();

        if(isset($data['nome']))
            $desktype->nome = $data['nome'];
        if(isset($data['numero_posti']))
            $desktype->nome = $data['numero_posti'];
        // TODO: creazione della geometrycollection
        //if(isset($data['disegno']))
            //$desktype->nome = $data['disegno'];

        $desktype->save();
        return Response::make("", 204);
    }

    public function destroy(Request $request)
    {
        if(Auth::user()->role() != "admin"){
            return Response::make("", 403);
        }

        $desktype = Desktype::findOrFail($request['id']);
        Desktype::destroy($request['id']);

        return Response::json($desktype, 200);
    }
}
