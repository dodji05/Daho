<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\CategoriesCircuitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=CategoriesCircuitRepository::class)
 *  
 *  @ApiResource( normalizationContext={"groups"={"catcircuit:read"}})
 */
class CategoriesCircuit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"circuit:read","catcircuit:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"circuit:read","catcircuit:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=CircuitsTouristiques::class, mappedBy="categorie")
     *  @ApiSubresource()
     * @Groups({"circuit:read","catcircuit:read"})
     */
    private $circuit;

    public function __construct()
    {
        $this->circuit = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
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
     * @return Collection<int, CircuitsTouristiques>
     */
    public function getCircuit(): Collection
    {
        return $this->circuit;
    }

    public function addCircuit(CircuitsTouristiques $circuit): self
    {
        if (!$this->circuit->contains($circuit)) {
            $this->circuit[] = $circuit;
            $circuit->setCategorie($this);
        }

        return $this;
    }

    public function removeCircuit(CircuitsTouristiques $circuit): self
    {
        if ($this->circuit->removeElement($circuit)) {
            // set the owning side to null (unless already changed)
            if ($circuit->getCategorie() === $this) {
                $circuit->setCategorie(null);
            }
        }

        return $this;
    }
}
