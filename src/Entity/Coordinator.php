<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\CoordinatorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CoordinatorRepository::class)
 * @ORM\Table (name="Coordinators")
 * @ORM\HasLifecycleCallbacks
 */
class Coordinator
{
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Zones::class, mappedBy="coordinator")
     */
    private $zone;

    public function __construct()
    {
        $this->zone = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Zones[]
     */
    public function getZone(): Collection
    {
        return $this->zone;
    }

    public function addZone(Zones $zone): self
    {
        if (!$this->zone->contains($zone)) {
            $this->zone[] = $zone;
            $zone->setCoordinator($this);
        }

        return $this;
    }

//    public function removeZone(Zones $zone): self
//    {
//        if ($this->zone->removeElement($zone)) {
//            // set the owning side to null (unless already changed)
//            if ($zone->getCoordinator() === $this) {
//                $zone->setCoordinator(null);
//            }
//        }
//
//        return $this;
//    }

    public function __toString()
    {
        return $this->getFullName();
    }
}
