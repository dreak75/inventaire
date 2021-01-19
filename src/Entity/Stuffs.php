<?php

namespace App\Entity;

use App\Repository\StuffsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StuffsRepository::class)
 */
class Stuffs
{

    const OWNER = [
        '0' => 'Les 2',
        '1' => 'Marjo',
        '2' => 'Guillaume'
    ];
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $property;

    /**
     * @ORM\Column(type="integer")
     */
    private $containerId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getProperty(): ?int
    {
        return $this->property;
    }

    public function getOwnerName(): ?string
    {
        return self::OWNER[$this->property];
    }

    public function setProperty(int $property): self
    {
        $this->property = $property;

        return $this;
    }

    public function getContainerId(): ?int
    {
        return $this->containerId;
    }

    public function setContainerId(int $containerId): self
    {
        $this->containerId = $containerId;

        return $this;
    }
}
