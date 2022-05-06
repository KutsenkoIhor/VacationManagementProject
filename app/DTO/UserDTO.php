<?php

declare(strict_types=1);

namespace App\DTO;

class UserDTO
{
    private int $id;
    private int|null $countryId;
    private int|null $cityId;
    private string|null $firstName;
    private string|null $lastName;
    private string $email;
    private string|null $googleAvatar;

    /**
     * @param int $id
     * @param int|null $countryId
     * @param int|null $cityId
     * @param string|null $firstName
     * @param string|null $lastName
     * @param string $email
     * @param string|null $googleAvatar
     */
    public function __construct(int $id, int|null $countryId, int|null $cityId, string|null $firstName, string|null $lastName, string $email, string|null $googleAvatar)
    {
        $this->id = $id;
        $this->countryId = $countryId;
        $this->cityId = $cityId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->googleAvatar = $googleAvatar;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getCountryId(): int|null
    {
        return $this->countryId;
    }

    /**
     * @return int|null
     */
    public function getCityId(): int|null
    {
        return $this->cityId;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): string|null
    {
        return $this->firstName;
    }

    /**
     * @return string|null
     */
    public function getLastName(): string|null
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getGoogleAvatar(): string|null
    {
        return $this->googleAvatar;
    }
}
