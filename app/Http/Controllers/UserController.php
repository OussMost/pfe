<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return $this->sendOkResponse(['users' => $users]);
    }


    public function sendOkResponse($data)
    {
        return response()->json(
            [
                'success' => true,
                'data' => $data
            ],
            200
        );
    }

    public function store(UserRequest $request)
    {
      /*  $user = User::create([
            'name' => "oussama", 
            'email' => "www.mahmoudi@hotmail.com", 
            'password' => "123456789"
        ]);*/
        $user = User::create([
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => Hash::make($request->password),
        ]);
        return $this->sendOkResponse(['user' => $user]);
    }

    public function update($id) {

        $users = User::find($id);
        if($users){
        $users->name="oussala1";
        $users->email="www.mahmoudii@hotmail.com";
        $users->password="123456789";
        $users->save();
        return $this->sendOkResponse(['user' => $users]);
        }
        return $this->sendOkResponse(['message' => "utilisateur inexistant"]);
    }

    public function delete($id)
    {

        $users = User::find($id);
        if($users){
        $users->delete();
        $users->save();
        return $this->sendOkResponse(['message' => "utilisateur supprimé"]);

        }
        return $this->sendOkResponse(['message' => "utilisateur inexistant"]);
    }
}
