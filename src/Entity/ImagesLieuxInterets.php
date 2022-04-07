<?php

namespace App\Entity;

use App\Repository\ImagesLieuxInteretsRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ImagesLieuxInteretsRepository::class)
 *  @ApiResource
 * @Vich\Uploadable
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
     * @Vich\UploadableField(mapping="lieux_images", fileNameProperty="url")
     * @var File
     */
    private $imageFile;

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

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
          //  $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }
}
