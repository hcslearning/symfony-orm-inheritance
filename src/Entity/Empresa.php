<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmpresaRepository")
 */
class Empresa
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $razonSocial;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $alias;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\DireccionEmpresa", inversedBy="empresa", cascade={"persist", "remove"})
     */
    private $direccion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRazonSocial(): ?string
    {
        return $this->razonSocial;
    }

    public function setRazonSocial(string $razonSocial): self
    {
        $this->razonSocial = $razonSocial;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getDireccion(): ?DireccionEmpresa
    {
        return $this->direccion;
    }

    public function setDireccion(?DireccionEmpresa $direccion): self
    {
        $this->direccion = $direccion;
        $direccion->setEmpresa($this);
        
        return $this;
    }
}
