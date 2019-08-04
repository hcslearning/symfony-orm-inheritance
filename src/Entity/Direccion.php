<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Superclass\UbicacionAbstract;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DireccionRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 */
class Direccion extends UbicacionAbstract
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
    
}
