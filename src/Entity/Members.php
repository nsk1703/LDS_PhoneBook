<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\MembersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=MembersRepository::class)
 * @ORM\Table(name="members")
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class Members
{
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="member_image", fileNameProperty="imageName")
     * @Assert\NotNull(message="Please upload a file")
     * @Assert\Image(maxSize="5M")
     *
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageName;


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $profession;

    /**
     * @ORM\ManyToOne(targetEntity=Zones::class, inversedBy="Members")
     * @ORM\JoinColumn(name="zone_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $zones;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getZones(): ?Zones
    {
        return $this->zones;
    }

    public function setZones(?Zones $zones): self
    {
        $this->zones = $zones;

        return $this;
    }

}
