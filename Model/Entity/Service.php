<?php
namespace App\Entity;

class Service {

    private ?int $id;
    private ?string  $date;
    private ?string $contentService;

    public  function  __construct(int $id =null, string $date = null, string $contentService = null) {
        $this->id = $id;
        $this->date = $date;
        $this->contentService = $contentService;
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
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @param string|null $date
     */
    public function setDate(?string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string|null
     */
    public function getContentService(): ?string
    {
        return $this->contentService;
    }

    /**
     * @param string|null $contentService
     */
    public function setContentService(?string $contentService): void
    {
        $this->contentService = $contentService;
    }

}