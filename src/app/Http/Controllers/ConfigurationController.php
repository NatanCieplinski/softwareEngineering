<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ConfigurationController extends Controller
{
    private function validation(Request $request, $req=false){
        return Validator::make($request->all(),[
            'nome' => $req ? 'required' : ''.'|string|max:1',
            'valore' => $req ? 'required' : ''.'|string|size:2',
        ]);
    }
 
    public function all(Request $request)
    {
        if(Auth::user()->role() != "admin"){
            return Response::make("", 403);
        }

        return Response::json(Configuration::paginate(), 200);
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
       
        $configuration = Configuration::create($data);

        return Response::make("", 201);
    }

    public function show(Request $request)
    {
        if(Auth::user()->role() != "admin"){
            return Response::make("", 403);
        }

        $configuration = Configuration::findOrFail($request['id']);
        return Response::json($configuration, 200);
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

        $configuration = Configuration::findOrFail($request['id']);

        $data = $validator->valid();

        if(isset($data['nome']))
            $configuration->nome = $data['nome'];
        if(isset($data['valore']))
            $configuration->valore = $data['valore'];

        $configuration->save();
        return Response::make("", 204);
    }

    public function destroy(Request $request)
    {
        if(Auth::user()->role() != "admin"){
            return Response::make("", 403);
        }

        $configuration = Configuration::findOrFail($request['id']);
        Configuration::destroy($request['id']);

        return Response::json($configuration, 200);
    }
}
