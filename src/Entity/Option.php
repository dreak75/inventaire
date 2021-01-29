<?php

namespace App\Entity;

use App\Repository\OptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OptionRepository::class)
 * @ORM\Table(name="`option`")
 */
class Option
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Stuffs::class, mappedBy="options")
     */
    private $stuffs;

    public function __construct()
    {
        $this->stuffs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Stuffs[]
     */
    public function getStuffs(): Collection
    {
        return $this->stuffs;
    }

    public function addStuff(Stuffs $stuff): self
    {
        if (!$this->stuffs->contains($stuff)) {
            $this->stuffs[] = $stuff;
        }

        return $this;
    }

    public function removeStuff(Stuffs $stuff): self
    {
        $this->stuffs->removeElement($stuff);

        return $this;
    }
}
