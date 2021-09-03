<?php

namespace App\Entity;

use App\Repository\ZonesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ZonesRepository::class)
 */
class Zones
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Zone;

    /**
     * @ORM\ManyToOne(targetEntity=Coordinator::class, inversedBy="zone")
     * @ORM\JoinColumn(name="coordinator_id", referencedColumnName="id", nullable=false, onDelete="SET NULL")
     */
    private $coordinator;

    /**
     * @ORM\OneToMany(targetEntity=Members::class, mappedBy="zones")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id", nullable=false)
     */
    private $Members;

    public function __construct()
    {
        $this->Members = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getZone(): ?string
    {
        return $this->Zone;
    }

    public function setZone(string $Zone): self
    {
        $this->Zone = $Zone;

        return $this;
    }

    public function getCoordinator(): ?Coordinator
    {
        return $this->coordinator;
    }

    public function setCoordinator(?Coordinator $coordinator): self
    {
        $this->coordinator = $coordinator;

        return $this;
    }

    /**
     * @return Collection|Members[]
     */
    public function getMembers(): Collection
    {
        return $this->Members;
    }

    public function addMember(Members $member): self
    {
        if (!$this->Members->contains($member)) {
            $this->Members[] = $member;
            $member->setZones($this);
        }

        return $this;
    }

    public function removeMember(Members $member): self
    {
        if ($this->Members->removeElement($member)) {
            // set the owning side to null (unless already changed)
            if ($member->getZones() === $this) {
                $member->setZones(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getZone();
    }
}
