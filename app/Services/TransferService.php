<?php

namespace App\Services;

use App\Models\Transfer;
use Illuminate\Support\Facades\DB;

class TransferService
{
    public Transfer $transfer;

    public function store($data)
    {
        try{
            DB::beginTransaction();

            $this->transfer = Transfer::Create($data);

            DB::commit();
        }
        catch (\Exception $exeption){
            DB::rollBack();
            return $exeption->getMessage();
        }
    }
}
