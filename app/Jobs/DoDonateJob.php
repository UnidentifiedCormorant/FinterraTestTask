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

    private $senderId;
    private $userId;
    private array $data;
    private $transferId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($senderId, $userId, $data, $transferId)
    {
        $this->senderId = $senderId;
        $this->userId = $userId;
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
        $sender = User::find($this->senderId);
        $user = User::find($this->userId);
        $transfer = Transfer::find($this->transferId);

        $sender->money -= $this->data['transferredMoney'];
        $user->money += $this->data['transferredMoney'];
        $transfer->status = 1;

        $sender->save();
        $user->save();
        $transfer->save();
    }
}
