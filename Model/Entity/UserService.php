<?php
namespace App\Entity;

class UserService {

    private ?int $id;
    private ?int $user_fk;
    private ?string $service_date;
    private ?string $subject;
    private ?string $description;

    public  function  __construct(int $id =null, int $user_fk = null, string $service_date = null, string $subject = null, string $description = null) {
        $this->id = $id;
        $this->user_fk = $user_fk;
        $this->service_date = $service_date;
        $this->subject = $subject;
        $this->description = $description;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getUserFk(): ?int {
        return $this->user_fk;
    }

    /**
     * @param int|null $user_fk
     */
    public function setUserFk(?int $user_fk): void {
        $this->user_fk = $user_fk;
    }

    /**
     * @return string|null
     */
    public function getServiceDate(): ?string {
        return $this->service_date;
    }

    /**
     * @param string|null $service_date
     */
    public function setServiceDate(?string $service_date): void {
        $this->service_date = $service_date;
    }

    /**
     * @return string|null
     */
    public function getSubject(): ?string {
        return $this->subject;
    }

    /**
     * @param string|null $subject
     */
    public function setSubject(?string $subject): void {
        $this->subject = $subject;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void {
        $this->description = $description;
    }

}