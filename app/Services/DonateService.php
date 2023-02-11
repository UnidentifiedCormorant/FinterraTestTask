<?php

namespace App\Services;

use App\Models\User;
use App\Traits\HoursCounter;
use Illuminate\Support\Facades\DB;

class DonateService
{
    use HoursCounter;

    public function storeCheck($data)
    {
        try{
            DB::beginTransaction();

            $sender = User::find($data['user_id']);
            $getter = User::find($data['getter_id']);

            $sender->money -= $data['transferredMoney'];
            $getter->money += $data['transferredMoney'];

            DB::commit();
        }
        catch (\Exception $exeption){
            DB::rollBack();
            return $exeption->getMessage();
        }
    }
}
