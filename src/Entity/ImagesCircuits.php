<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\ImagesCircuitsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImagesCircuitsRepository::class)
 * 
 */
class ImagesCircuits
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({"circuit:read","catcircuit:read"})
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity=CircuitsTouristiques::class, inversedBy="images")
     */
    private $circuit;

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

    public function getCircuit(): ?CircuitsTouristiques
    {
        return $this->circuit;
    }

    public function setCircuit(?CircuitsTouristiques $circuit): self
    {
        $this->circuit = $circuit;

        return $this;
    }
}
