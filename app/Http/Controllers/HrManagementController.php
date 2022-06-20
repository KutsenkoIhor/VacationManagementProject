<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HrManagementController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function listHr(): Application|Factory|View
    {
        return view('pages.manageHR');
    }

}
