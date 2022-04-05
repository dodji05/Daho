<?php

namespace App\Entity;

use App\Repository\ImagesLieuxInteretsRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImagesLieuxInteretsRepository::class)
 *  @ApiResource
 */
class ImagesLieuxInterets
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *  @Groups({"lieux:read","ville:read","circuit:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({"lieux:read","ville:read","circuit:read"})
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity=LieuxInterets::class, inversedBy="images")
     */
    private $lieuinteret;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getLieuinteret(): ?LieuxInterets
    {
        return $this->lieuinteret;
    }

    public function setLieuinteret(?LieuxInterets $lieuinteret): self
    {
        $this->lieuinteret = $lieuinteret;

        return $this;
    }
}
