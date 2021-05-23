<?php
namespace App\Entity\User;

class UserProfile {

    private ?int $id;
    private ?int $user_fk;
    private ?string $pseudo;
    private ?string $avatar;
    private ?string $brithday;
    private ?string $city;
    private ?string $address;
    private ?string $code_zip;
    private ?string $country;
    private ?string  $more_infos;
    private ?string $phone;


    public function __construct(int $id =null, int $user_fk = null, string $pseudo = null, string  $avatar = null, string $brithday = null, string $city = null,
                                string $address = null, string  $code_zip = null, string $country = null, string $more_infos = null, string $phone = null)
    {
        $this->id = $id;
        $this->user_fk = $user_fk;
        $this->pseudo = $pseudo;
        $this->avatar = $avatar;
        $this->brithday = $brithday;
        $this->city = $city;
        $this->address = $address;
        $this->code_zip = $code_zip;
        $this->country = $country;
        $this->more_infos = $more_infos;
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
    public function getPseudo(): ?string {
        return $this->pseudo;
    }

    /**
     * @param string|null $pseudo
     */
    public function setPseudo(?string $pseudo): void {
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
    public function getBrithday(): ?string {
        return $this->brithday;
    }

    /**
     * @param string|null $brithday
     */
    public function setBrithday(?string $brithday): void {
        $this->brithday = $brithday;
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
    public function setCity(?string $city): void {
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
    public function setAddress(?string $address): void {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getCodeZip(): ?string {
        return $this->code_zip;
    }

    /**
     * @param string|null $code_zip
     */
    public function setCodeZip(?string $code_zip): void {
        $this->code_zip = $code_zip;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string {
        return $this->country;
    }

    /**
     * @param string|null $country
     */
    public function setCountry(?string $country): void {
        $this->country = $country;
    }

    /**
     * @return string|null
     */
    public function getMoreInfos(): ?string {
        return $this->more_infos;
    }

    /**
     * @param string|null $more_infos
     */
    public function setMoreInfos(?string $more_infos): void {
        $this->more_infos = $more_infos;
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