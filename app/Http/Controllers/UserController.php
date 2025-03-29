<?php

namespace App\Http\Controllers;
use App\Services\UserServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserServices $userService){
        return view('users.index', ['users' => $userService->listUsers()]);
    }

    public function first(UserServices $userService) {
        return collect($userService->listUsers())->first();
    }

    public function show(UserServices $UserService, $id){
        $user = collect($UserService->listUsers())->filter(function($item) use ($id){
            return $item['id'] == $id;
        })->first();

        return $user;   
    }
    
}
