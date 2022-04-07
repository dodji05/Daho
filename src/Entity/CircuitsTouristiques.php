<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Gedmo\Mapping\Annotation as Gedmo;
use PhpParser\Node\Expr\Cast\Double;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\CircuitsTouristiquesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=CircuitsTouristiquesRepository::class)
 * @ApiResource( normalizationContext={"groups"={"circuit:read"}})
 */
class CircuitsTouristiques
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *  @Groups({"lieux:read","ville:read","circuit:read","catcircuit:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"lieux:read","ville:read","circuit:read","catcircuit:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"lieux:read","ville:read","circuit:read","catcircuit:read"})
     */
    private $video;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     * @Groups({"lieux:read","ville:read","circuit:read","catcircuit:read"})
     */
    private $Description;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     * @Groups({"lieux:read","ville:read","circuit:read","catcircuit:read"})
     */
    private $CourteDescription;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"lieux:read","ville:read","circuit:read","catcircuit:read"})
     */
    private $Prix;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"lieux:read","ville:read","circuit:read","catcircuit:read"})
     */
    private $Distance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"lieux:read","ville:read","circuit:read","catcircuit:read"})
     */
    private $Duree;

    /**
     * @ORM\OneToMany(targetEntity=PointsArrets::class, mappedBy="circuits")
     * @Groups({"lieux:read","ville:read","circuit:read","catcircuit:read","pointarret:read"})
     */
    private $pointsArrets;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=ImagesCircuits::class, mappedBy="circuit")
     *  @Groups({"circuit:read","catcircuit:read"})
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity=CommentairesCircuits::class, mappedBy="circuit")
     *  @Groups({"circuit:read"})
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity=Reservations::class, mappedBy="circuit")
     */
    private $reservations;

    /**
     * @ORM\ManyToOne(targetEntity=CategoriesCircuit::class, inversedBy="circuit")
     *  
     *  
     */
    private $categorie;

    public function __construct()
    {
        $this->pointsArrets = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->reservations = new ArrayCollection();
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

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(?string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getCourteDescriptionn(): ?string
    {
        return $this->CourteDescription;
    }

    public function setCourteDescription(?string $CourteDescription): self
    {
        $this->CourteDescription = $CourteDescription;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(?float $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getDistance(): ?float
    {
        return $this->Distance;
    }

    public function setDistance(?float $Distance): self
    {
        $this->Distance = $Distance;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->Duree;
    }

    public function setDuree(?int $Duree): self
    {
        $this->Duree = $Duree;

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
            $pointsArret->setCircuits($this);
        }

        return $this;
    }

    public function removePointsArret(PointsArrets $pointsArret): self
    {
        if ($this->pointsArrets->removeElement($pointsArret)) {
            // set the owning side to null (unless already changed)
            if ($pointsArret->getCircuits() === $this) {
                $pointsArret->setCircuits(null);
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

    /**
     * @return Collection<int, ImagesCircuits>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(ImagesCircuits $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setCircuit($this);
        }

        return $this;
    }

    public function removeImage(ImagesCircuits $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getCircuit() === $this) {
                $image->setCircuit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommentairesCircuits>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(CommentairesCircuits $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setCircuit($this);
        }

        return $this;
    }

    public function removeCommentaire(CommentairesCircuits $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getCircuit() === $this) {
                $commentaire->setCircuit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservations>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservations $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setCircuit($this);
        }

        return $this;
    }

    public function removeReservation(Reservations $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getCircuit() === $this) {
                $reservation->setCircuit(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?CategoriesCircuit
    {
        return $this->categorie;
    }

    public function setCategorie(?CategoriesCircuit $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
