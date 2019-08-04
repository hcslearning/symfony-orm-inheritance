<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PedidoRepository")
 */
class Pedido
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cliente", inversedBy="pedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cliente;

    /**
     * @ORM\Column(type="float")
     */
    private $total;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Despacho", cascade={"persist", "remove"})
     */
    private $despachoPrincipal;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Despacho", mappedBy="pedido", orphanRemoval=true)
     */
    private $despachosAdicionales;

    public function __construct()
    {
        $this->despachosAdicionales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeImmutable
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeImmutable $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getDespachoPrincipal(): ?Despacho
    {
        return $this->despachoPrincipal;
    }

    public function setDespachoPrincipal(?Despacho $despachoPrincipal): self
    {
        $this->despachoPrincipal = $despachoPrincipal;

        return $this;
    }

    /**
     * @return Collection|Despacho[]
     */
    public function getDespachosAdicionales(): Collection
    {
        return $this->despachosAdicionales;
    }

    public function addDespachosAdicionale(Despacho $despachosAdicionale): self
    {
        if (!$this->despachosAdicionales->contains($despachosAdicionale)) {
            $this->despachosAdicionales[] = $despachosAdicionale;
            $despachosAdicionale->setPedido($this);
        }

        return $this;
    }

    public function removeDespachosAdicionale(Despacho $despachosAdicionale): self
    {
        if ($this->despachosAdicionales->contains($despachosAdicionale)) {
            $this->despachosAdicionales->removeElement($despachosAdicionale);
            // set the owning side to null (unless already changed)
            if ($despachosAdicionale->getPedido() === $this) {
                $despachosAdicionale->setPedido(null);
            }
        }

        return $this;
    }
}
