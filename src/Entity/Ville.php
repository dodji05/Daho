<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 *  @Vich\Uploadable
 * @ApiResource(
 * normalizationContext={"groups"={"ville:read"}}
 * )
 */

class Ville
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"ville:read","circuit:read","lieux:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"ville:read","circuit:read","lieux:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"ville:read","circuit:read","lieux:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"ville:read"})
     */
    private $video;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"ville:read"})
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"ville:read"})
     */
    private $longitude;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"ville:read"})
     */
    private $createdAt;

    /**
     *  @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"ville:read"})
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=ImageVille::class, mappedBy="ville")
     * @Groups({"ville:read"})
     */
    private $images;

     

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"ville:read"})
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=LieuxInterets::class, mappedBy="ville")
     *  @Groups({"ville:read"})
     */
    private $lieuxInterets;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->lieuxInterets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

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

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(?string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|ImageVille[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(ImageVille $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setVille($this);
        }

        return $this;
    }

    public function removeImage(ImageVille $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getVille() === $this) {
                $image->setVille(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|LieuxInterets[]
     */
    public function getLieuxInterets(): Collection
    {
        return $this->lieuxInterets;
    }

    public function addLieuxInteret(LieuxInterets $lieuxInteret): self
    {
        if (!$this->lieuxInterets->contains($lieuxInteret)) {
            $this->lieuxInterets[] = $lieuxInteret;
            $lieuxInteret->setVille($this);
        }

        return $this;
    }

    public function removeLieuxInteret(LieuxInterets $lieuxInteret): self
    {
        if ($this->lieuxInterets->removeElement($lieuxInteret)) {
            // set the owning side to null (unless already changed)
            if ($lieuxInteret->getVille() === $this) {
                $lieuxInteret->setVille(null);
            }
        }

        return $this;
    }
   
}
