<?php

namespace App\Entity;

use App\Repository\ContainersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ContainersRepository::class)
 * @Vich\Uploadable
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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="container_image", fileNameProperty="filename")
     * 
     * @var File|null
     * @Assert\Image(
     *  mimeTypes="image/jpeg"
     * )
     */
    private $imageFile;
    
    /**
     * @ORM\Column(type="string")
     *
     * @var string|null
     */
    private $filename;

    
    /**
     * @ORM\OneToMany(targetEntity=Stuffs::class, mappedBy="container")
     */
    private $stuffs;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at; 

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
   
   
    function getImageFile(): ?File {
        return $this->imageFile;
    }

    function getFilename(): ?string {
        return $this->filename;
    }

    function setImageFile(?File $imageFile) {
        $this->imageFile = $imageFile;
        
        // Only change the updated af if the file is really uploaded to avoid database updates.
        // This is needed when the file should be set when loading the entity.
        if ($this->imageFile instanceof File) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    function setFilename(?string $filename) {
        $this->filename = $filename;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
   
   
}
