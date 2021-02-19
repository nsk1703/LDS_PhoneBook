<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\MembersRepository;
use Doctrine\ORM\Mapping as ORM;
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


}
