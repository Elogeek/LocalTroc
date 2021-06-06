<?php
namespace App\Entity;

use App\Entity\User;

class UserService {

    private ?int $id;
    private ?User $user;
    private ?string $serviceDate;
    private ?string $subject;
    private ?string $description;
    private ?string $image;

    /**
     * UserService constructor.
     * @param int|null $id
     * @param \App\Entity\User|null $user
     * @param string|null $serviceDate
     * @param string|null $subject
     * @param string|null $description
     */
    public  function  __construct(int $id =null, User $user = null, string $serviceDate = null, string $subject = null, string $description = null, string $image = null) {
        $this->id = $id;
        $this->user = $user;
        $this->serviceDate = $serviceDate;
        $this->subject = $subject;
        $this->description = $description;
        $this->image = $image;
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
     * @return User|null
     */
    public function getUser(): ?User {
        return $this->user;
    }

    /**
     * @param User|null $user
     */
    public function setUser(User $user): void {
        $this->user = $user;
    }

    /**
     * @return string|null
     */
    public function getServiceDate(): ?string {
        return $this->serviceDate;
    }

    /**
     * @param string|null $serviceDate
     */
    public function setServiceDate(string $serviceDate): void {
        $this->serviceDate = $serviceDate;
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
    public function setSubject(string $subject): void {
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
    public function setDescription(string $description): void {
        $this->description = $description;
    }

    /**
     * Return the service image.
     * @return string
     */
    public function getImage(): string {
        return $this->image;
    }

    /**
     * Set the service image.
     * @param string $image
     */
    public function setImage(string $image) {
        $this->image = $image;
    }

}