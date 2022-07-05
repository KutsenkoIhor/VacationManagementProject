<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Vacation\VacationDaysLeftCalculationService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    private UserRepositoryInterface $userRepository;
    private VacationDaysLeftCalculationService $service;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param VacationDaysLeftCalculationService $service
     */
    public function __construct(UserRepositoryInterface $userRepository, VacationDaysLeftCalculationService $service)
    {
        $this->userRepository = $userRepository;
        $this->service = $service;
    }

    /**
     * @return Application|Factory|View
     */
    public function getUserParametersByUserId(): Application|Factory|View
    {
        $userParameters = $this->userRepository->getUserParameters(Auth::id());
        $vacationDaysLeft = $this->service->getVacationDaysLeftFilteredByType(Auth::id(), Carbon::now());

        return view('pages.homePage', ['userParameters' => $userParameters, 'vacationDaysLeft' => $vacationDaysLeft]);
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function logout(): Application|RedirectResponse|Redirector
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
