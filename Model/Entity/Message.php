<?php

namespace App\Entity\User;

use App\Entity\User;
use App\Entity\UserService;

class Message {

    private ?int $id;
    private ?User $userFrom;
    private ?UserService $userService;
    private ?string $content;
    private ?string $date;

    public function __construct(int $id = null, User $fromUser = null, UserService $userService = null, string $content = null, string $date = null) {
        $this->id = $id;
        $this->userFrom = $fromUser;
        $this->userService = $userService;
        $this->content = $content;
        $this->date = $date;
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
    public function getUserFrom(): ?User {
        return $this->userFrom;
    }

    /**
     * @param User $user
     */
    public function setUserFrom(User $user): void {
        $this->userFrom = $user;
    }

    /**
     * @return UserService|null
     */
    public function getUserService(): ?UserService {
        return $this->userService;
    }

    /**
     * @param UserService $userService
     */
    public function setUserService(UserService $userService ): void {
        $this->userService = $userService;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string {
        return $this->content;
    }

    /**
     * @param string|null $content
     */
    public function setContent(string $content): void {
        $this->content = $content;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string {
        return $this->date;
    }

    /**
     * @param string|null $date
     */
    public function setDate(string $date): void {
        $this->date = $date;
    }

}

