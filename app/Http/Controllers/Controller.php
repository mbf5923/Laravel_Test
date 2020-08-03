<?php

namespace App\Http\Controllers;

use App\Traits\CustomResponse;
use App\Traits\FailedResponseTrait;
use App\Traits\SuccessResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use FailedResponseTrait,SuccessResponseTrait;



}
