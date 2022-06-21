<?php

namespace App\Repositories\Interfaces;

use App\Models\EmployeePm;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface EmployeesAndPmRepositoryInterface
{
    public function allCollection(): Collection;
    public function getCollectionTeamOnePm($idPm): Collection;
    public function createTeam(int $idPm, int $idEmployee): object;
    public function getModelTeamPm(int $idPm, int $idEmployee): EmployeePm|null;
    public function getPMModelById(int $idEmployee): User;
}
