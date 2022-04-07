<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\HttpFoundation\File\File;
use App\Repository\LieuxInteretsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=LieuxInteretsRepository::class)
 *  @ApiResource( normalizationContext={"groups"={"lieux:read"}})
 * @Vich\Uploadable
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
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"ville:read","lieux:read","circuit:read","catlieux:read","pointarret:read"})
     */
    private $courteDescription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({"ville:read","lieux:read","circuit:read","catlieux:read","pointarret:read"})
     */
    private $video;

     /**
     * @Vich\UploadableField(mapping="lieux_images", fileNameProperty="video")
     * @var File
     */
    private $videoFile;

    /**
     * @ORM\Column(type="float",nullable=true)
     *    @Groups({"ville:read","lieux:read","circuit:read","catlieux:read"})
     */
    private $latitude;

    /**
     * @ORM\Column(type="float", nullable=true)
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
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     *  @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->pointsArrets = new ArrayCollection();
        $this->status = true;
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
    public function getCourteDescription(): ?string
    {
        return $this->courteDescription;
    }

    public function setCourteDescription(?string $courteDescription): self
    {
        $this->courteDescription = $courteDescription;

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

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
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

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function setVideoFile(File $image = null)
    {
        $this->videoFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
          //  $this->updatedAt = new \DateTime('now');
        }
    }

    public function getVideoFile()
    {
        return $this->videoFile;
    }
}
