<?php
namespace App\Entity;

use Role;

class User {

    private ?int $id;
    private ?Role $role;
    private ?string $firstname;
    private ?string $lastName;
    private ?string $email;
    private ?string $password;

    public function __construct(int $id =null, Role $role = null, string $firstname = null, string $lastName = null, string  $email = null, string $password = null) {
        $this->id = $id;
        $this->role = $role;
        $this->firstname = $firstname;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
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
     * @return Role|null
     */
    public function getRoleFk(): ?Role {
        return $this->role;
    }

    /**
     * @param Role|null $role
     */
    public function setRoleFk(?Role $role): void {
        $this->role = $role;
    }
    /**
     * @return string|null
     */
    public function getFirstname(): ?string {
        return $this->firstname;
    }

    /**
     * @param string|null $username
     */
    public function setFirstname(?string $username): void {
        $this->firstname = $username;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     */
    public function setLastName(?string $lastName): void {
        $this->lastName = $lastName;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string {
        return $this->email;
    }

    /**
     * @param string|null $mail
     */
    public function setEmail(?string $email): void {
        $this->email = $email;
    }


    /**
     * @return string|null
     */
    public function getPassword(): ?string {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void {
        $this->password = $password;
    }

}