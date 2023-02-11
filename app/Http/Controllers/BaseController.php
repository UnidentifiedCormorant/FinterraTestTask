<?php

namespace App\Http\Controllers;

use App\Services\DonateService;
use App\Services\IService;
use App\Services\TransferService;

class BaseController extends Controller
{
    public $donatService;
    public $transferService;

    public function __construct(DonateService $donateService, TransferService $transferService)
    {
        $this->donatService = $donateService;
        $this->transferService = $transferService;
    }
}
