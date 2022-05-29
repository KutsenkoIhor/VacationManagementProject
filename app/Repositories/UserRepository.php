<?php

namespace App\Repositories;

use App\DTO\UserDTO;
use App\Factories\UserFactory;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private UserFactory $homePageFactory;

    /**
     * @param UserFactory $homePageFactory
     */
    public function __construct(UserFactory $homePageFactory)
    {
        $this->homePageFactory = $homePageFactory;
    }

    /**
     * @return object
     */
    public function all(): object
    {
        return User::all()->sortByDesc('updated_at');
    }

    /**
     * @return object
     */
    public function allPagination(
        array $role,
        string|int|null $countryId,
        string|int|null $cityId,
    ): object {
        $queryBuilder = User::query();

        if ($role !== []) {
            $queryBuilder->whereIn('id', $role);
        }
//        dd($queryBuilder);
        if ($countryId !== 'All') {
            $queryBuilder->where('country_id', $countryId);
//            dd($queryBuilder->get());
//            dd($queryBuilder->orderBy('updated_at', 'DESC')->paginate(5));
        }
        if ($cityId !== 'All') {
            $queryBuilder->where('city_id', $cityId);
        }

        $z =  $queryBuilder->orderBy('updated_at', 'DESC')->paginate(5);

//        dd($z);
        return $z;


    }


//    public function allPaginations (): object
//    {
//        dd(User::orderBy('updated_at', 'DESC')->paginate(5));
//        return User::orderBy('updated_at', 'DESC')->paginate(5);
//    }
//        return User::where('country_id', '1')->where('country_id', '1')->orderBy('updated_at', 'DESC')->paginate(5);
//        return User::orderBy('updated_at', 'DESC')->paginate(5);



    /**
     * @param $arrIdUserElasticsearch
     * @return object
     */
    public function Elasticsearchpagination($arrIdUserElasticsearch): object
    {
        return User::whereIn('id', $arrIdUserElasticsearch)->orderBy('updated_at', 'DESC')->paginate(5);
    }

    /**
     * @param int $userId
     * @return UserDTO
     */
    public function getUserParameters (int $userId): UserDTO
    {
        return $this->homePageFactory->makeDTOFromModelCollection(User::where('id', $userId)->get());
    }

    /**
     * @param string $email
     * @return object|null
     */
    public function searchEmail(string $email): object|null
    {
        return User::where('email', $email)->first();
    }

    /**
     * @param string|null $firstName
     * @param string|null $lastName
     * @param string|null $userEmail
     * @param string|null $userAvatar
     * @param int|null $countryId
     * @param int|null $cityId
     * @return object
     */
    public function createUser(string|null $firstName, string|null $lastName, string|null $userEmail, string|null $userAvatar, int|null $countryId, int|null $cityId): object
    {
        return User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $userEmail,
            'google_avatar' => $userAvatar,
            'country_id' => $countryId,
            'city_id' => $cityId,
        ]);
    }

    /**
     * @param string|null $firstName
     * @param string|null $lastName
     * @param string|null $userEmail
     * @param int|null $countryId
     * @param int|null $cityId
     * @return object
     */
    public function updateOrCreate(string|null $firstName, string|null $lastName, string|null $userEmail, int|null $countryId, int|null $cityId): object
    {
        return User::updateOrCreate(
            ['email' => $userEmail],
            ['first_name'=> $firstName, 'last_name' => $lastName, 'country_id' => $countryId, 'city_id' => $cityId,]
        );
    }

    /**
     * @param int $userId
     * @return User
     */
    public function getUserModelById (int $userId): User
    {
        return User::where('id', $userId)->first();
    }
}
