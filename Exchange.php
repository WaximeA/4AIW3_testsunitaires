<?php

class Exchange
{
    /** @var User $receiver */
    private $receiver;
    /** @var Product $product */
    private $product;
    /** @var DateTime $startDate */
    private $startDate;
    /** @var DateTime $endDate */
    private $endDate;
    /** @var EmailSender $emailSender */
    private $emailSender;
    /** @var DatabaseConnection $dbConnexion */
    private $dbConnexion;

    /**
     * Exchange constructor
     *
     * @param User     $receiver
     * @param Product  $product
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @param          $emailSender
     * @param          $dbConnexion
     */
    public function __construct(
        User $receiver,
        Product $product,
        DateTime $startDate,
        DateTime $endDate,
        EmailSender $emailSender,
        DatabaseConnection $dbConnexion
    ) {
        $this->receiver    = $receiver;
        $this->product     = $product;
        $this->startDate   = $startDate;
        $this->endDate     = $endDate;
        $this->emailSender = $emailSender;
        $this->dbConnexion = $dbConnexion;
    }

    /**
     * Description getReceiver function
     *
     * @return User
     */
    public function getReceiver(): User
    {
        return $this->receiver;
    }

    /**
     * Description setReceiver function
     *
     * @param User $receiver
     *
     * @return void
     * @throws Exception
     */
    public function setReceiver(User $receiver): void
    {
        if (!$receiver->isValid()) {
            throw new Exception('The revceiver is not valid');
        } elseif ($receiver->getAge() < 18) {
            $this->emailSender->sendEmail($receiver->getEmail(), 'Your minor, that\' too bad...');
        }

        $this->receiver = $receiver;
    }

    /**
     * Description getProduct function
     *
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * Description setProduct function
     *
     * @param Product $product
     *
     * @return void
     * @throws Exception
     */
    public function setProduct(Product $product): void
    {
        if (!$product->isValid()) {
            throw new Exception('The product is not valid');
        }

        $this->product = $product;
    }

    /**
     * Description getStartDate function
     *
     * @return DateTime
     */
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    /**
     * Description setStartDate function
     *
     * @param DateTime $startDate
     *
     * @return void
     */
    public function setStartDate(DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * Description getEndDate function
     *
     * @return DateTime
     */
    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    /**
     * Description setEndDate function
     *
     * @param DateTime $endDate
     *
     * @return void
     */
    public function setEndDate(DateTime $endDate): void
    {
        $this->endDate = $endDate;
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

    public function isValidDate(DateTime $startDate, DateTime $endDate) :bool {
        /** @var DateTime $now */
        $now = date("Y-m-d H:i:s");

        if ($endDate - $startDate <= 0 || $startDate < $now){
            return false;
        }

        return true;
    }

    public function save()
    {
        if (!empty($this->receiver) || !empty($this->product) ||  $this->isValidDate($this->startDate, $this->endDate)) {
            try {
                $this->dbConnexion->saveUser($this->receiver);
                $this->dbConnexion->saveProduct($this->product);
                $this->dbConnexion->saveProduct($this);
            } catch (Exception $exception) {
                throw new Exception('There is issues during saving');
            }
        }
    }

}
//
//EXERCICE : la classe “Exchange”
//                     - Implémenter une classe Exchange et sa classe de
//test
//- Détails fonctionnels :
//- Un Exchange possède un receiver (de type User), un
//produit (de type Product), un owner contenu dans le
//produit (de type User), une date de début, une date de
//fin, un composant d’envoie d’email (de type
//EmailSender) et un composant de connexion à la base de
//données (de type DBConnection)
//- L’exchange est enregistré si le owner, le receiver et le
//produit sont valides. Il faut que les dates soient valides
//(date de début dans le future)
//- Si le receiver est mineur, lui envoyer un mail
//                                            - Opérations :
//- save() dans la classe Exchange
//                        - testSave() dans la classe ExchangeTest