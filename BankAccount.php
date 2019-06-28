<?php

class ExchangeAccount
{
    /** @var int $amount */
    private $amount;
    /** @var User $owner */
    private $owner;
    /** @var EmailSender $emailSender */
    private $emailSender;
    /** @var DatabaseConnection $dbConnexion */
    private $dbConnexion;
    /** @var int $balance */
    private $balance;

    /**
     * ExchangeAccount constructor
     *
     * @param User               $owner
     * @param EmailSender        $emailSender
     * @param DatabaseConnection $dbConnexion
     * @param int $balance
     */
    public function __construct(
        User $owner,
        EmailSender $emailSender,
        DatabaseConnection $dbConnexion,
        int $balance
    ) {
        $this->owner       = $owner;
        $this->emailSender = $emailSender;
        $this->dbConnexion = $dbConnexion;
        $this->balance = $balance;
    }

    /**
     * Description getOwner function
     *
     * @return User
     */
    public function getOwner(): User
    {
        return $this->owner;
    }

    /**
     * Description setOwner function
     *
     * @param User $owner
     *
     * @return void
     */
    public function setOwner(User $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * Description getEmailSender function
     *
     * @return EmailSender
     */
    public function getEmailSender(): EmailSender
    {
        return $this->emailSender;
    }

    /**
     * Description setEmailSender function
     *
     * @param EmailSender $emailSender
     *
     * @return void
     */
    public function setEmailSender(EmailSender $emailSender): void
    {
        $this->emailSender = $emailSender;
    }

    /**
     * Description getDbConnexion function
     *
     * @return DatabaseConnection
     */
    public function getDbConnexion(): DatabaseConnection
    {
        return $this->dbConnexion;
    }

    /**
     * Description setDbConnexion function
     *
     * @param DatabaseConnection $dbConnexion
     *
     * @return void
     */
    public function setDbConnexion(DatabaseConnection $dbConnexion): void
    {
        $this->dbConnexion = $dbConnexion;
    }

    /**
     * Description getBalance function
     *
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     * Description setBalance function
     *
     * @param int $balance
     *
     * @return void
     * @throws Exception
     */
    public function setBalance(int $balance): void
    {
        if ($balance < 0 || $balance > 1000) {
            throw new Exception('The balance must be between 0 and 1000');
        }

        $this->balance = $balance;
    }

    public function credit() {
        $message = [];
        $newBalance = $this->balance + $this->amount;

        if ($newBalance > 1000) {
            $newBalance = $this->balance + $this->amount - 1000;
            $message['difference'] = $this->balance + $this->amount;
        }

        $message['addedAmount'] = $this->amount;
        $message['newBalance'] = $newBalance;

        if ($newBalance !== $this->balance) {
            $this->emailSender->sendEmail($this->owner->getEmail(), 'Your balance is now egal to '. $newBalance);
        }

        return $message;
    }
}