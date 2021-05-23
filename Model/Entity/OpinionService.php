<?php
namespace App\Entity\User;
namespace App\Entity\UserService;

class OpinionService {

    private ?int $id;
    private ?int $user_fk;
    private ?int $author_fk;
    private ?string $content;
    private ?string $date;

    public function __construct(int $id = null, int $user_fk = null, int $author_fk = null, string $content = null, string $date = null) {
        $this->id = $id;
        $this->user_fk = $user_fk;
        $this->author_fk = $author_fk;
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
     * @return int|null
     */
    public function getAuthorFk(): ?int {
        return $this->author_fk;
    }

    /**
     * @param int|null $author_fk
     */
    public function setAuthorFk(?int $author_fk): void {
        $this->author_fk = $author_fk;
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
    public function setContent(?string $content): void {
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
    public function setDate(?string $date): void {
        $this->date = $date;
    }

}