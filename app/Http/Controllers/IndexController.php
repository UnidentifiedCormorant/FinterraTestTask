<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(){
        $users = User::all();

        return view('index', compact('users'));
    }

    public function donate(Request $request, $userId){

        $user = User::find($userId);

        try
        {
            DB::beginTransaction();

            auth()->user()->money -= $request->money;
            $user->money += $request->money;

            auth()->user()->save();
            $user->save();

            DB::commit();
        }
        catch (\Exception $exception)
        {
            DB::rollback();
            return $exception->getMessage();
        }

        return redirect(route('users.index'));
    }
}
