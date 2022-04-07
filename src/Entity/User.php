<?php

namespace App\Entity;

use App\Repository\UserRepository;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @ApiResource( normalizationContext={"groups"={"user:read"}})
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     *  @Groups({"user:read"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\OneToMany(targetEntity=Articles::class, mappedBy="auteur")
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity=CommentairesCircuits::class, mappedBy="user")
     * @Groups({"user:read"})
     */
    private $commentairesCircuits;

    /**
     * @ORM\OneToMany(targetEntity=Reservations::class, mappedBy="user")
     *  @Groups({"user:read"})
     */
    private $reservations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({"user:read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({"user:read"})
     */
    private $prenoms;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({"user:read"})
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({"user:read"})
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({"user:read"})
     */
    private $isoCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({"user:read"})
     */
    private $dialCode;

    /**
     * @ORM\OneToMany(targetEntity=ApiToken::class, mappedBy="user")
     *  @Groups({"user:read"})
     */
    private $fcm_token;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->commentairesCircuits = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->fcm_token = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection|Articles[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Articles $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setAuteur($this);
        }

        return $this;
    }

    public function removeArticle(Articles $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getAuteur() === $this) {
                $article->setAuteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CommentairesCircuits[]
     */
    public function getCommentairesCircuits(): Collection
    {
        return $this->commentairesCircuits;
    }

    public function addCommentairesCircuit(CommentairesCircuits $commentairesCircuit): self
    {
        if (!$this->commentairesCircuits->contains($commentairesCircuit)) {
            $this->commentairesCircuits[] = $commentairesCircuit;
            $commentairesCircuit->setUser($this);
        }

        return $this;
    }

    public function removeCommentairesCircuit(CommentairesCircuits $commentairesCircuit): self
    {
        if ($this->commentairesCircuits->removeElement($commentairesCircuit)) {
            // set the owning side to null (unless already changed)
            if ($commentairesCircuit->getUser() === $this) {
                $commentairesCircuit->setUser(null);
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
            $reservation->setUser($this);
        }

        return $this;
    }

    public function removeReservation(Reservations $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getUser() === $this) {
                $reservation->setUser(null);
            }
        }

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenoms(): ?string
    {
        return $this->prenoms;
    }

    public function setPrenoms(?string $prenoms): self
    {
        $this->prenoms = $prenoms;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getIsoCode(): ?string
    {
        return $this->isoCode;
    }

    public function setIsoCode(?string $isoCode): self
    {
        $this->isoCode = $isoCode;

        return $this;
    }

    public function getDialCode(): ?string
    {
        return $this->dialCode;
    }

    public function setDialCode(?string $dialCode): self
    {
        $this->dialCode = $dialCode;

        return $this;
    }

    /**
     * @return Collection<int, ApiToken>
     */
    public function getFcmToken(): Collection
    {
        return $this->fcm_token;
    }

    public function addFcmToken(ApiToken $fcmToken): self
    {
        if (!$this->fcm_token->contains($fcmToken)) {
            $this->fcm_token[] = $fcmToken;
            $fcmToken->setUser($this);
        }

        return $this;
    }

    public function removeFcmToken(ApiToken $fcmToken): self
    {
        if ($this->fcm_token->removeElement($fcmToken)) {
            // set the owning side to null (unless already changed)
            if ($fcmToken->getUser() === $this) {
                $fcmToken->setUser(null);
            }
        }

        return $this;
    }
}
