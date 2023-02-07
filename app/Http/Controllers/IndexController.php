<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $users = User::all();

        return view('index', compact('users'));
    }

    public function donate(Request $request, $userId){
        dd($request->date, $request->time, $request->money, $userId);
    }
}
