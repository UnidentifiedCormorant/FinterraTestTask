<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\DoDonateJob;
use App\Models\Transfer;
use App\Models\User;
use App\Services\DonateService;
use App\Services\TransferService;
use Carbon\Carbon;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Rules\CheckPlannedTransfers;
use App\Http\Requests\DonateRequest;

class IndexController extends Controller
{
    public function index()
    {
        $usersJoin = User::where('users.id', '<>', auth()->id())
            ->leftJoin('transfers', 'users.id', '=', 'transfers.user_id')
            ->select('*', 'users.id as u_id')
            ->orderBy('transfers.date', 'desc')
            ->get();

        $users = $usersJoin->unique('u_id');

        return view('index', compact('users'));
    }

    public function donate(DonateRequest $request, $userId, DonateService $donateService, TransferService $transferService)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['getter_id'] = $userId;

        $transferService->store($data);

        DoDonateJob::dispatch($data, $transferService->transfer->id)
            ->afterCommit()
            ->delay(now()->addHours($donateService->CountHours($data)));

        //DoDonateJob::dispatch($data, $this->transferService->transfer->id)->afterCommit()->delay(now()->addSeconds($this->donatService->CountHours($data))); //Для быстрого теста

        return redirect(route('users.index'));
    }
}
