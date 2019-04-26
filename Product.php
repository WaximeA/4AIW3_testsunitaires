<?php

class Product
{
    /** @var string $name */
    private $name = '';
    /** @var null|User $owner */
    private $owner = null;

    /**
     * Product constructor
     *
     * @param string    $name
     * @param null|User $owner
     */
    public function __construct(
        string $name,
        ?User $owner
    ) {
        $this->name  = $name;
        $this->owner = $owner;
    }

    /**
     * Description getName function
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Description setName function
     *
     * @param string $name
     *
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Description getUser function
     *
     * @return null|User
     */
    public function getUser(): ?User
    {
        return $this->owner;
    }

    /**
     * Description setUser function
     *
     * @param null|User $owner
     *
     * @return void
     */
    public function setUser(?User $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * Description setOwner function
     *
     * @param null|User $owner
     *
     * @return void
     */
    public function setOwner(?User $owner): void
    {
        $this->owner = $owner;
    }

    public function isValid()
    {
        if (empty($this->name) && !isset($this->owner) && !$this->owner->isValid()) {
            return false;
        }

        return true;
    }
}