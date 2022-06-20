<?php

namespace App\Repositories;

use App\Models\EmployeePm;
use App\Repositories\Interfaces\EmployeesAndPmRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class EmployeesAndPmRepository implements EmployeesAndPmRepositoryInterface
{
    public function allCollection(): Collection
    {
        return EmployeePm::all();
    }

    public function getCollectionTeamOnePm($idPm): Collection
    {
        return EmployeePm::where('pm_id', $idPm)->get();
    }

    public function createTeam(int $idPm, int $idEmployee): object
    {
        return EmployeePm::create([
            'pm_id' => $idPm,
            'employee_id' => $idEmployee,
        ]);
    }

    public function getModelTeamPm(int $idPm, int $idEmployee): EmployeePm|null
    {
        return EmployeePm::where([
            ['pm_id', $idPm],
            ['employee_id', $idEmployee],
        ])->first();
    }

}
