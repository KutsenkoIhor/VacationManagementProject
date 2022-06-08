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

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function getUserParametersByUserId(VacationDaysLeftCalculationService $service): Application|Factory|View
    {
        $userId = Auth::id();
        $userParameters = $this->userRepository->getUserParameters($userId);

        $vacationDaysLeft = $service->getVacationDaysLeftFilteredByType(Auth::id(), Carbon::now());

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
