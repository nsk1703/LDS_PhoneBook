<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\CoordinatorRepository;
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

    public function getId(): ?int
    {
        return $this->id;
    }

}
