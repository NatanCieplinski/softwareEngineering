<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class UserController extends Controller
{
    use ThrottlesLogins;

    /**
     * Username used in ThrottlesLogins trait
     * 
     * @return string
     */
    public function username(){
        return 'email';
    }

    private function validation(Request $request, $req=false){
        return Validator::make($request->all(),[
            'nome' => 'string|max:255',
            'username' => 'string|max:255',
            'email' => $req ? 'required' : ''.'|string|email|max:255|unique:users',
            'password' => $req ? 'required' : ''.'|string',
        ]);
    }

    public function all(){
        if( Auth::user()->role() != "supervisor" &&
            Auth::user()->role() != "admin"
        ){
            return Response::make("", 403);
        }

        return Response::json(User::paginate(), 200);
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
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return Response::make("", 201);
    }

    public function show(Request $request){
        if( Auth::user()->role() != "supervisor" &&
            Auth::user()->role() != "admin" &&
            Auth::user()->id != $request['id']
        ){
            return Response::make("", 403);
        }

        $user = User::findOrFail($request['id']);
        return Response::json($user, 200);
    }

    public function update(Request $request){
        if( Auth::user()->role() != "supervisor" &&
            Auth::user()->role() != "admin" &&
            Auth::user()->id != $request['id']
        ){
            return Response::make("", 403);
        }
        
        $validator = $this->validation($request);

        if($validator->fails()){
            return Response::json($validator->messages(), 400);
        }

        $user = User::findOrFail($request['id']);

        $data = $validator->valid();

        if(isset($data['nome']))
            $user->nome = $data['nome'];
        if(isset($data['username']))
            $user->username = $data['username'];
        if(isset($data['email']))
            $user->email = $data['email'];
        if(isset($data['password']))
            $user->password = Hash::make($data['password']);

        $user->save();
        return Response::make("", 204);
    }

    public function destroy(Request $request){
        if(Auth::user()->role() != "admin"){
            return Response::make("", 403);
        }

        $user = User::findOrFail($request['id']);
        User::destroy($request['id']);

        return Response::json($user, 200);
    }

    public function ban(Request $request){
        if( Auth::user()->role() != "supervisor" &&
            Auth::user()->role() != "admin"
        ){
            return Response::make("", 403);
        }

        $user = User::findOrFail($request['id']);
        $user->is_bannato = true;
        $user->save();

        return Response::make("", 204);
    }

    public function register(Request $request){
        $validator = $this->validation($request, true);

        if($validator->fails()){
            return Response::json($validator->messages(), 400);
        }

        $data = $validator->valid();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        $access_token = $user->createToken('auth')->accessToken;

        return Response::json([
            'user' => $user,
            'access_token' => $access_token
        ], 200);
    }

    public function login(Request $request){
        $validator = $this->validation($request, true);

        if ($this->hasTooManyLoginAttempts($request)){
            $this->fireLockoutEvent($request);
            return Response::make("", 429);
        }

        if($validator->fails()){
            return Response::json($validator->messages(), 400);
        }

        if(!Auth::attempt($validator->valid())){
            $this->incrementLoginAttempts($request);
            return Response::make("", 401);
        }

        $access_token = Auth::user()->createToken('auth')->accessToken;

        return Response::json([
            'user' => Auth::user(),
            'access_token' => $access_token
        ], 200);
    }

    public function logout(Request $request){
        Auth::user()->token()->revoke();
        return Response::make("", 204);
    }

    public function reservations(Request $request){
        if( Auth::user()->role() != "supervisor" &&
            Auth::user()->role() != "admin" &&
            Auth::user()->id != $request['id']
        ){
            return Response::make("", 403);
        }

        $user = User::findOrFail($request['id']);
        $reservations = $user->reservations();
        
        return Response::json($reservations, 200);
    }
}
