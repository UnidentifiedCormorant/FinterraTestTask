<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\DoDonateJob;
use App\Models\User;
use Carbon\Carbon;
use DateTimeImmutable;
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

        $origin = date_create(date("Y-m-d"));
        $target = date_create($request['date']);
        $interval = date_diff($origin, $target);

        $hours = substr($request['time'], 0, 2);
        $postponement = $interval->format("%a") * 24 + (int)$hours;  //postponement - отсрочка

        //Версия с прибавкой часов; она легко сломается, если сервер, на котором крутится php artisan queue:work ляжет
        //DoDonateJob::dispatch(auth()->id(), $userId, $data)->afterCommit()->delay(now()->addHours($postponement));

        return redirect(route('users.index'));

        //TODO: Сделать таблицу, в которую будут заноситься платежи, в том числе запланированные; при проведении при проведении платежа в jobs, статус платежа меняется
    }
}
