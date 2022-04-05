<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\CategorieLieuxInteretsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieLieuxInteretsRepository::class)
 *  @ApiResource( normalizationContext={"groups"={"catlieux:read"}})
 */
class CategorieLieuxInterets
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *  @Groups({"lieux:read","circuit:read","catlieux:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({"lieux:read","circuit:read","catlieux:read"})
     */
    private $name;

      /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"ville:read"})
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=LieuxInterets::class, mappedBy="categorie")
     * @Groups({"ville:read","catlieux:read"})
     *
     */
    private $lieuxInterets;

    public function __construct()
    {
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
            $lieuxInteret->setCategorie($this);
        }

        return $this;
    }

    public function removeLieuxInteret(LieuxInterets $lieuxInteret): self
    {
        if ($this->lieuxInterets->removeElement($lieuxInteret)) {
            // set the owning side to null (unless already changed)
            if ($lieuxInteret->getCategorie() === $this) {
                $lieuxInteret->setCategorie(null);
            }
        }

        return $this;
    }
}
