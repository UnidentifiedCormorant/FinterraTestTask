<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\DoDonateJob;
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

        $data = request()->validate([
           'money' => '',
           'date' => '',
           'time' => '',
        ]);

        try{
            DB::beginTransaction();

            $sender = auth()->user();
            $user = User::find($userId);

            if($sender->money - $data['money'] < 0){
                DB::rollBack();
                return redirect(route('users.index'));
            }

            $sender->money -= $data['money'];
            $user->money += $data['money'];

            DB::commit();
        }
        catch (\Exception $exeption){
            DB::rollBack();
            return $exeption->getMessage();
        }

        DoDonateJob::dispatch(auth()->id(), $userId, $data)->afterCommit()->delay(now()->addMinutes(2));

        return redirect(route('users.index'));
    }
}
