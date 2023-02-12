<?php

namespace App\Jobs;

use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class DoDonateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 25;

    private array $data;
    private $transferId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $transferId)
    {
        $this->data = $data;
        $this->transferId = $transferId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            DB::beginTransaction();

            $sender = User::find($this->data['user_id']);
            $getter = User::find($this->data['getter_id']);
            $transfer = Transfer::find($this->transferId);

            $sender->money -= $this->data['transferredMoney'];
            $getter->money += $this->data['transferredMoney'];
            $transfer->status = 1;

            $sender->save();
            $getter->save();
            $transfer->save();

            DB::commit();
        }
        catch (\Exception $exeption){
            DB::rollBack();
        }
    }
}
