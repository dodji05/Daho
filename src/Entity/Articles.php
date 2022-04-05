<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;


/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 *  @Vich\Uploadable
 */
class Articles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contenu;

    /**
     * @Gedmo\Slug(fields={"titre"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime_immutable")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $publie = true;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $datePublication;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageArticle;

    /**
     * @Vich\UploadableField(mapping="blog_images", fileNameProperty="imageArticle")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\ManyToMany(targetEntity=CategoriesArticles::class, inversedBy="articles")
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articles")
     */
    private $auteur;

    /**
     * @ORM\ManyToMany(targetEntity=MotsClesArticles::class, mappedBy="articles")
     */
    private $motsCles;

    /**
     * @ORM\OneToMany(targetEntity=CommentairesArticles::class, mappedBy="articles")
     */
    private $commentaires;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
        $this->motsCles = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->datePublication = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

//    public function setSlug(?string $slug): self
//    {
//        $this->slug = $slug;
//
//        return $this;
//    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

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

    public function getPublie(): ?bool
    {
        return $this->publie;
    }

    public function setPublie(?bool $publie): self
    {
        $this->publie = $publie;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeImmutable
    {
        return $this->datePublication;
    }

    public function setDatePublication(?\DateTimeImmutable $datePublication): self
    {
        $this->datePublication = $datePublication;

        return $this;
    }
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function getImageArticle(): ?string
    {
        return $this->imageArticle;
    }

    public function setImageArticle(string $imageArticle): self
    {
        $this->imageArticle = $imageArticle;

        return $this;
    }

    /**
     * @return Collection|CategoriesArticles[]
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(CategoriesArticles $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie[] = $categorie;
        }

        return $this;
    }

    public function removeCategorie(CategoriesArticles $categorie): self
    {
        $this->categorie->removeElement($categorie);

        return $this;
    }

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * @return Collection|MotsClesArticles[]
     */
    public function getMotsCles(): Collection
    {
        return $this->motsCles;
    }

    public function addMotsCle(MotsClesArticles $motsCle): self
    {
        if (!$this->motsCles->contains($motsCle)) {
            $this->motsCles[] = $motsCle;
            $motsCle->addArticle($this);
        }

        return $this;
    }

    public function removeMotsCle(MotsClesArticles $motsCle): self
    {
        if ($this->motsCles->removeElement($motsCle)) {
            $motsCle->removeArticle($this);
        }

        return $this;
    }
    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * @return Collection|CommentairesArticles[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(CommentairesArticles $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setArticles($this);
        }

        return $this;
    }

    public function removeCommentaire(CommentairesArticles $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getArticles() === $this) {
                $commentaire->setArticles(null);
            }
        }

        return $this;
    }
}
