<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class DireccionEmpresa extends Direccion {
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Empresa", mappedBy="direccion", cascade={"persist", "remove"})
     */
    private $empresa;
    
    
    public function getId(): ?int {
        return $this->id;
    }

    public function getEmpresa(): ?Empresa
    {
        return $this->empresa;
    }

    public function setEmpresa(?Empresa $empresa): self
    {
        $this->empresa = $empresa;

        // set (or unset) the owning side of the relation if necessary
        $newDireccion = $empresa === null ? null : $this;
        if ($newDireccion !== $empresa->getDireccion()) {
            $empresa->setDireccion($newDireccion);
        }

        return $this;
    }
    
    
}
