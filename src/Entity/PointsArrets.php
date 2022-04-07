<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use App\Repository\PointsArretsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PointsArretsRepository::class)
 * @ApiResource( normalizationContext={"groups"={"pointarret:read"}})
 */
class PointsArrets
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"lieux:read","ville:read","circuit:read","catcircuit:read","pointarret:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"lieux:read","ville:read","circuit:read","catcircuit:read","pointarret:read"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=CircuitsTouristiques::class, inversedBy="pointsArrets")
     * @Groups({"lieux:read","ville:read"})
     *
     */
    private $circuits;

    /**
     * @ORM\ManyToOne(targetEntity=LieuxInterets::class, inversedBy="pointsArrets")
     * @Groups({"ville:read","circuit:read","pointarret:read"})
     *
     */
    private $lieuInteret;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     * @Groups({"lieux:read","ville:read","circuit:read","pointarret:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     * @Groups({"lieux:read","ville:read","circuit:read","pointarret:read"})
     */
    private $courteDescription;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * 
     */
    private $status;

    /**
     *  @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     *  @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime_immutable")
     */
    private $updateAt;

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

    public function getCircuits(): ?CircuitsTouristiques
    {
        return $this->circuits;
    }

    public function setCircuits(?CircuitsTouristiques $circuits): self
    {
        $this->circuits = $circuits;

        return $this;
    }

    public function getLieuInteret(): ?LieuxInterets
    {
        return $this->lieuInteret;
    }

    public function setLieuInteret(?LieuxInterets $lieuInteret): self
    {
        $this->lieuInteret = $lieuInteret;

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

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

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

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTimeImmutable $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getCourteDescriptionn(): ?string
    {
        return $this->courteDescription;
    }

    public function setCourteDescription(?string $courteDescription): self
    {
        $this->courteDescription = $courteDescription;

        return $this;
    }
}
