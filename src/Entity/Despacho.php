<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\UbicacionAbstract;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DespachoRepository")
 */
class Despacho extends UbicacionAbstract
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaEnvio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $empresa;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pedido", inversedBy="despachosAdicionales")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pedido;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaRecepcion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaEnvio(): ?\DateTimeInterface
    {
        return $this->fechaEnvio;
    }

    public function setFechaEnvio(?\DateTimeInterface $fechaEnvio): self
    {
        $this->fechaEnvio = $fechaEnvio;

        return $this;
    }

    public function getEmpresa(): ?string
    {
        return $this->empresa;
    }

    public function setEmpresa(?string $empresa): self
    {
        $this->empresa = $empresa;

        return $this;
    }

    public function getPedido(): ?Pedido
    {
        return $this->pedido;
    }

    public function setPedido(?Pedido $pedido): self
    {
        $this->pedido = $pedido;

        return $this;
    }

    public function getFechaRecepcion(): ?\DateTimeInterface
    {
        return $this->fechaRecepcion;
    }

    public function setFechaRecepcion(?\DateTimeInterface $fechaRecepcion): self
    {
        $this->fechaRecepcion = $fechaRecepcion;

        return $this;
    }
}
