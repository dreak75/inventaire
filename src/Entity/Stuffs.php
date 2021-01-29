<?php

namespace App\Entity;

use App\Repository\StuffsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    

    /**
     * @ORM\ManyToMany(targetEntity=Option::class, inversedBy="stuffs")
     */
    private $options;

    /**
     * @ORM\ManyToOne(targetEntity=Containers::class, inversedBy="stuffs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $container;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

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
    
    /**
     * @return Collection|Option[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Option $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
            $option->addStuff($this);
        }

        return $this;
    }

    public function removeOption(Option $option): self
    {
        if ($this->options->removeElement($option)) {
            $option->removeStuff($this);
        }

        return $this;
    }

    public function getContainer(): ?Containers
    {
        return $this->container;
    }

    public function setContainer(?Containers $container): self
    {
        $this->container = $container;

        return $this;
    }
}
