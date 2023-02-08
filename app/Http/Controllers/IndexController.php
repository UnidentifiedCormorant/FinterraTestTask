<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\DoDonateJob;
use App\Models\Transfer;
use App\Models\User;
use Carbon\Carbon;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(){
        //TODO: получше потестить
        $users = User::join('transfers', 'users.id', '=', 'transfers.user_id')->get();
        return view('index', compact('users'));
    }

    public function donate(Request $request, $userId){

        //TODO: Проверка доната, с учётом запланированных донатов

        $data = request()->validate([
           'transferredMoney' => '',
           'date' => '',
           'time' => '',
        ]);

        try{
            DB::beginTransaction();

            $sender = auth()->user();
            $user = User::find($userId);

            if($sender->money - $data['transferredMoney'] < 0){
                DB::rollBack();
                return redirect(route('users.index'));
            }

            $sender->money -= $data['transferredMoney'];
            $user->money += $data['transferredMoney'];

            DB::commit();
        }
        catch (\Exception $exeption){
            DB::rollBack();
            return $exeption->getMessage();
        }

        $transfer = null;
        try{
            DB::beginTransaction();

            $data['user_id'] = auth()->id();
            $data['getter_id'] = $userId;

            $transfer = Transfer::Create($data);

            DB::commit();
        }
        catch (\Exception $exeption){
            DB::rollBack();
            return $exeption->getMessage();
        }

        $origin = date_create(date("Y-m-d"));
        $target = date_create($request['date']);
        $interval = date_diff($origin, $target);

        $hours = substr($request['time'], 0, 2);
        $postponement = $interval->format("%a") * 24 + (int)$hours;  //postponement - отсрочка

        //DoDonateJob::dispatch(auth()->id(), $userId, $data)->afterCommit()->delay(now()->addHours($postponement));
        DoDonateJob::dispatch(auth()->id(), $userId, $data, $transfer->id)->delay(now()->addMinutes(2));

        return redirect(route('users.index'));
    }
}
