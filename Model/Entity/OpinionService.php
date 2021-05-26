<?php
namespace App\Entity\User;

use App\Entity\User;
use App\Entity\UserService;

class OpinionService {

    private ?int $id;
    private ?User $user;
    private ?User $author;
    private ?string $content;
    private ?string $date;

    /**
     * OpinionService constructor.
     * @param int|null $id
     * @param User|null $user
     * @param User|null $author
     * @param string|null $content
     * @param string|null $date
     */
    public function __construct(int $id = null, User $user = null, User $author = null, string $content = null, string $date = null) {
        $this->id = $id;
        $this->user = $user;
        $this->author = $author;
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
    public function getUser(): ?User {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void {
        $this->user = $user;
    }

    /**
     * @return User|null
     */
    public function getAuthor(): ?User {
        return $this->author;
    }

    /**
     * @param User|null $author
     */
    public function setAuthor(User $author): void {
        $this->author = $author;
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