<?php

namespace App\Http\Controllers;

use App\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class MapController extends Controller
{
    private function validation(Request $request, $req=false){
        return Validator::make($request->all(),[
            'nome' => $req ? 'required' : ''.'|string|max:255',
        ]);
    }
 
    public function all(Request $request)
    {
        return Response::json(Map::paginate(), 200);
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

        $map = Map::create($data);

        return Response::make("", 201);
    }

    public function show(Request $request)
    {
        $map = Map::findOrFail($request['id']);
        return Response::json($map, 200);
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

        $map = Map::findOrFail($request['id']);

        $data = $validator->valid();

        if(isset($data['nome']))
            $map->nome = $data['nome'];

        $map->save();
        return Response::make("", 204);
    }

    public function destroy(Request $request)
    {
        if(Auth::user()->role() != "admin"){
            return Response::make("", 403);
        }

        $map = Map::findOrFail($request['id']);
        Map::destroy($request['id']);

        return Response::json($map, 200);
    }

    public function upload(Request $request)
    {
        // TODO
    }

    public function download(Request $request)
    {
        // TODO
    }
}
