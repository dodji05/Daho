<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\CommentairesCircuitsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentairesCircuitsRepository::class)
 * @ApiResource
 */
class CommentairesCircuits
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *  @Groups({"user:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commentairesCircuits")
     * 
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=CircuitsTouristiques::class, inversedBy="commentaires")
     * @Groups({"user:read"})
     */
    private $circuit;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"circuit:read","user:read"})
     */
    private $note;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"circuit:read","user:read"})
     */
    private $contenu;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCircuit(): ?CircuitsTouristiques
    {
        return $this->circuit;
    }

    public function setCircuit(?CircuitsTouristiques $circuit): self
    {
        $this->circuit = $circuit;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(?string $contenu): self
    {
        $this->contenu = $contenu;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
