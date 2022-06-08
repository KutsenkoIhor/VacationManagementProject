<?php

namespace App\Handlers;

use App\Models\User;

class ListEmployeesHandler
{
    /**
     * @param string $firstName
     * @param string $lastName
     * @return string
     */
    public function getUserName(string $firstName, string $lastName): string
    {
        $fName = $this->mb_ucfirst(mb_strtolower($firstName));
        $lName = $this->mb_ucfirst(mb_strtolower($lastName));
        return $lName . " " . $fName;
    }

    /**
     * @param string $string
     * @return string
     */
    private function mb_ucfirst(string $string): string
    {
        return mb_strtoupper(mb_substr($string, 0, 1)).mb_substr($string, 1);
    }

    /**
     * @param User $userModel
     * @return array
     */
    public function getArrRoles(User $userModel): array
    {
        $arrRoles = [];
        foreach ($userModel->getRoleNames() as $role) {
            $arrRoles[] = $role;
        }
        return $arrRoles;
    }

    /**
     * @param User $userModel
     * @return string
     */
    public function getStrRoles(User $userModel): string
    {
        $arrRoles = [];
        foreach ($userModel->getRoleNames() as $role) {
            $arrRoles[] = $role;
        }
        return implode(", ", $arrRoles);
    }

    /**
     * @param array $arrRole
     * @param User $modelUser
     * @return void
     */
    public function assignListRoles(array $arrRole, User $modelUser): void
    {
        foreach ($arrRole as $role) {
            $modelUser->assignRole($role);
        }
    }

    /**
     * @param User $modelUser
     * @return void
     */
    public function removeAllRole(User $modelUser): void
    {
        foreach ($modelUser->getRoleNames() as $role) {
            $modelUser->removeRole($role);
        }
    }

    /**
     * @param array $arrElasticsearch
     * @return array
     */
    public function getIdFromArrElasticsearch(array $arrElasticsearch): array
    {
        $arrIdUserElasticsearch = [];
        foreach ($arrElasticsearch as $key => $value) {
            $arrIdUserElasticsearch[] = substr($key, 6);
        }
        return $arrIdUserElasticsearch;
    }

    /**
     * @param $role
     * @return array
     */
    public function getArrIdUsersWithSpecificRole($role): array
    {
        $arrIdRole = [];
        $collectionUser = User::role($role)->get();
        foreach ($collectionUser as $user) {
            $arrIdRole[$user['id']] = $user['id'];
        }
        return $arrIdRole;
    }
}
