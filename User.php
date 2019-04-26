<?php

declare(strict_types=1);

class User
{
    /**
     * Maximum age required
     *
     * @var int MAX_AGE_REQUIRED
     */
    const MAX_AGE_REQUIRED = 13;
    /**
     * Maximum age required
     *
     * @var int MAX_AGE_REQUIRED
     */
    const REGEX_EMAIL_VALIDATION = ' /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ';
    /** @var string $firstName */
    private $firstName = '';
    /** @var string $lastName */
    private $lastName = '';
    /** @var string $email */
    private $email = 0;
    /** @var int $age */
    private $age;

    /**
     * User constructor
     *
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $age
     */
    public function __construct($firstName, $lastName, $email, $age)
    {
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
        $this->email     = $email;
        $this->age       = $age;
    }

    /**
     * Description getFirstName function
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Description setFirstName function
     *
     * @param string $firstName
     *
     * @return void
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * Description getLastName function
     *
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Description setLastName function
     *
     * @param string $lastName
     *
     * @return void
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * Description getEmail function
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Description setEmail function
     *
     * @param string $email
     *
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Description getAge function
     *
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * Description setAge function
     *
     * @param int $age
     *
     * @return void
     */
    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    /**
     * Description isValid function
     *
     * @return bool
     */
    public function isValid()
    {
        if (!$this->validateEmail($this->email) || !$this->validateAge($this->age) || !$this->validateName($this->firstName, $this->lastName)) {
            return false;
        }

        return true;
    }

    /**
     * Description validateEmail function
     *
     * @param $email
     *
     * @return bool
     */
    public function validateEmail($email)
    {
        if (!$email || !preg_match(self::REGEX_EMAIL_VALIDATION, $email)) {
            return false;
        }

        return true;
    }

    /**
     * Description validateAge function
     *
     * @param $age
     *
     * @return bool
     */
    public function validateAge($age)
    {
        if ($age < self::MAX_AGE_REQUIRED) {
            return false;
        }

        return true;
    }

    /**
     * Description validateName function
     *
     * @param $firstName
     * @param $lastName
     *
     * @return bool
     */
    public function validateName($firstName, $lastName)
    {
        if (!$firstName || !$lastName) {
            return false;
        }

        return true;
    }
}