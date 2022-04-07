<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ReservationsRepository::class)
 *  @ApiResource
 */
class Reservations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *  @Groups({"user:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservations")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=CircuitsTouristiques::class, inversedBy="reservations")
     */
    private $circuit;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *  @Groups({"user:read"})
     */
    private $dateCircuit;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({"user:read"})
     */
    private $etat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modePaiement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etatPaiement;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAt;

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

    public function getDateCircuit(): ?\DateTimeInterface
    {
        return $this->dateCircuit;
    }

    public function setDateCircuit(?\DateTimeInterface $dateCircuit): self
    {
        $this->dateCircuit = $dateCircuit;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getModePaiement(): ?string
    {
        return $this->modePaiement;
    }

    public function setModePaiement(string $modePaiement): self
    {
        $this->modePaiement = $modePaiement;

        return $this;
    }

    public function getEtatPaiement(): ?string
    {
        return $this->etatPaiement;
    }

    public function setEtatPaiement(?string $etatPaiement): self
    {
        $this->etatPaiement = $etatPaiement;

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

    public function getUpdateAt(): ?\DateTime
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTime $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }
}
