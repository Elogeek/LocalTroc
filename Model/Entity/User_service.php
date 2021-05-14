<?php
namespace App\Entity;

class User_service {

    private ?int $id;
    private ?int $serviceFk;
    private ?int $userFK;

    public function __construct(int $id = null, int $serviceFk = null, int $userFK = null) {
        $this->id = $id;
        $this->serviceFk = $serviceFk;
        $this->userFK = $userFK;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getServiceFk(): ?int
    {
        return $this->serviceFk;
    }

    /**
     * @param int|null $serviceFk
     */
    public function setServiceFk(?int $serviceFk): void
    {
        $this->serviceFk = $serviceFk;
    }

    /**
     * @return int|null
     */
    public function getUserFK(): ?int
    {
        return $this->userFK;
    }

    /**
     * @param int|null $userFK
     */
    public function setUserFK(?int $userFK): void
    {
        $this->userFK = $userFK;
    }

}