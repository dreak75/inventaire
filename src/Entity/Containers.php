<?php

namespace App\Entity;

use App\Repository\ContainersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContainersRepository::class)
 */
class Containers
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
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;
    

    /**
     * @ORM\OneToMany(targetEntity=Stuffs::class, mappedBy="container")
     */
    private $stuffs; 

    public function __construct(){
        $this->created_at = new \datetime();
        $this->affaires = new \Doctrine\Common\Collections\ArrayCollection();
        $this->stuffs = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
    
   /* public function getAffaires(): Collection
    {
        return $this->affaires;
    }*/

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
           $stuff->setContainer($this);
       }

       return $this;
   }

   public function removeStuff(Stuffs $stuff): self
   {
       if ($this->stuffs->removeElement($stuff)) {
           // set the owning side to null (unless already changed)
           if ($stuff->getContainer() === $this) {
               $stuff->setContainer(null);
           }
       }

       return $this;
   }
}
