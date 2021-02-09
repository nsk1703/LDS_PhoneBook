<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\MembersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MembersRepository::class)
 * @ORM\Table(name="members")
 * @ORM\HasLifecycleCallbacks
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


}
