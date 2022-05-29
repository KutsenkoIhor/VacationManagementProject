<?php

namespace App\Handlers;

use App\Models\User;

class ListEmployeesHandler
{
    public function getUserName(string $firstName, string $lastName): string
    {
        $fName = $this->mb_ucfirst(mb_strtolower($firstName));
        $lName = $this->mb_ucfirst(mb_strtolower($lastName));
        return $lName . " " . $fName;
    }

    private function mb_ucfirst(string $string): string
    {
        return mb_strtoupper(mb_substr($string, 0, 1)).mb_substr($string, 1);
    }

    public function getStrRoles(User $userModel): string
    {
        $arrRoles = [];
        foreach ($userModel->getRoleNames() as $role) {
            $arrRoles[] = $role;
        }
        return implode(", ", $arrRoles);
    }

    public function getArrRoles(User $userModel): array
    {
        $arrRoles = [];
        foreach ($userModel->getRoleNames() as $role) {
            $arrRoles[] = $role;
        }
        return $arrRoles;
    }

    public function getIdFromArrElasticsearch(array $arrElasticsearch): array
    {
        $arrIdUserElasticsearch = [];
        foreach ($arrElasticsearch as $key => $value) {
            $arrIdUserElasticsearch[] = substr($key, 6);

        }
//        dd($arrIdUserElasticsearch);
        return $arrIdUserElasticsearch;

    }

}
