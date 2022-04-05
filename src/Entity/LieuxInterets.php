<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;

use App\Repository\LieuxInteretsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LieuxInteretsRepository::class)
 *  @ApiResource( normalizationContext={"groups"={"lieux:read"}})
 *
 */
class LieuxInterets
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *  @Groups({"ville:read","lieux:read","circuit:read","pointarret:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({"ville:read","lieux:read","circuit:read","catlieux:read","pointarret:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"ville:read","lieux:read","circuit:read","catlieux:read","pointarret:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({"ville:read","lieux:read","circuit:read","catlieux:read","pointarret:read"})
     */
    private $video;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *    @Groups({"ville:read","lieux:read","circuit:read","catlieux:read"})
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"ville:read","lieux:read","circuit:read","catlieux:read"})
     */
    private $longitude;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="lieuxInterets")
     * @ApiSubresource()
     *  @Groups({"lieux:read"})
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity=CategorieLieuxInterets::class, inversedBy="lieuxInterets")
     * @Groups({"lieux:read"})
     *
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=ImagesLieuxInterets::class, mappedBy="lieuinteret")
     *  @Groups({"ville:read","lieux:read","circuit:read"})
     */
    private $images;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     *  @Groups({"ville:read","lieux:read"})
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=PointsArrets::class, mappedBy="lieuInteret")
     * 
     */
    private $pointsArrets;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->pointsArrets = new ArrayCollection();
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

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCategorie(): ?CategorieLieuxInterets
    {
        return $this->categorie;
    }

    public function setCategorie(?CategorieLieuxInterets $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|ImagesLieuxInterets[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(ImagesLieuxInterets $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setLieuinteret($this);
        }

        return $this;
    }

    public function removeImage(ImagesLieuxInterets $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getLieuinteret() === $this) {
                $image->setLieuinteret(null);
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
     * @return Collection|PointsArrets[]
     */
    public function getPointsArrets(): Collection
    {
        return $this->pointsArrets;
    }

    public function addPointsArret(PointsArrets $pointsArret): self
    {
        if (!$this->pointsArrets->contains($pointsArret)) {
            $this->pointsArrets[] = $pointsArret;
            $pointsArret->setLieuInteret($this);
        }

        return $this;
    }

    public function removePointsArret(PointsArrets $pointsArret): self
    {
        if ($this->pointsArrets->removeElement($pointsArret)) {
            // set the owning side to null (unless already changed)
            if ($pointsArret->getLieuInteret() === $this) {
                $pointsArret->setLieuInteret(null);
            }
        }

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
}
