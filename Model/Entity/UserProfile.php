<?php
namespace App\Entity\User;

use App\Entity\User;

class UserProfile {

    private ?int $id;
    private ?User $user;
    private ?string $pseudo;
    private ?string $avatar;
    private ?string $birthday;
    private ?string $city;
    private ?string $address;
    private ?string $codeZip;
    private ?string  $moreInfo;
    private ?string $phone;

    /**
     * UserProfile constructor.
     * @param int|null $id
     * @param int|null $user
     * @param string|null $pseudo
     * @param string|null $avatar
     * @param string|null $birthday
     * @param string|null $city
     * @param string|null $address
     * @param string|null $codeZip
     * @param string|null $country
     * @param string|null $moreInfo
     * @param string|null $phone
     */
    public function __construct(int $id = null, int $user = null, string $pseudo = null, string  $avatar = null, string $birthday = null, string $city = null,
                                string $address = null, string  $codeZip = null, string $moreInfo = null, string $phone = null)
    {
        $this->id = $id;
        $this->user = $user;
        $this->pseudo = $pseudo;
        $this->avatar = $avatar;
        $this->birthday = $birthday;
        $this->city = $city;
        $this->address = $address;
        $this->codeZip = $codeZip;
        $this->moreInfo = $moreInfo;
        $this->phone = $phone;
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
     * @return string|null
     */
    public function getPseudo(): ?string {
        return $this->pseudo;
    }

    /**
     * @param string|null $pseudo
     */
    public function setPseudo(string $pseudo): void {
        $this->pseudo = $pseudo;
    }

    /**
     * @return string|null
     */
    public function getAvatar(): ?string {
        return $this->avatar;
    }

    /**
     * @param string|null $avatar
     */
    public function setAvatar(?string $avatar): void {
        $this->avatar = $avatar;
    }

    /**
     * @return string|null
     */
    public function getBirthday(): ?string {
        return $this->birthday;
    }

    /**
     * @param string|null $birthday
     */
    public function setBirthday(?string $birthday): void {
        $this->birthday = $birthday;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string {
        return $this->city;
    }

    /**
     * @param string|null $city
     */
    public function setCity(string $city): void {
        $this->city = $city;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(string $address): void {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getCodeZip(): ?string {
        return $this->codeZip;
    }

    /**
     * @param string|null $codeZip
     */
    public function setCodeZip(string $codeZip): void {
        $this->codeZip = $codeZip;
    }

    /**
     * @return string|null
     */
    public function getMoreInfos(): ?string {
        return $this->moreInfo;
    }

    /**
     * @param string|null $moreInfo
     */
    public function setMoreInfos(?string $moreInfo): void {
        $this->moreInfo = $moreInfo;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void {
        $this->phone = $phone;
    }

}