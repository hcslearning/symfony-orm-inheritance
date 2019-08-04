<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Embeddable\ContactInfo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClienteRepository")
 */
class Cliente implements UserInterface {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Embedded(class="\App\Entity\Embeddable\ContactInfo", columnPrefix=false)
     * @var ContactInfo
     */
    private $contactInfo;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pedido", mappedBy="cliente")
     */
    private $pedidos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DireccionCliente", mappedBy="cliente", orphanRemoval=true)
     */
    private $direcciones;

    public function __construct() {
        $this->contactInfo = new ContactInfo();
        $this->pedidos = new ArrayCollection();
        $this->direcciones = new ArrayCollection();
    }

    public function __call($name, $arguments) {
        return call_user_func_array(
                [$this->contactInfo, $name],
                $arguments
        );
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string {
        return (string) $this->password;
    }

    public function setPassword(string $password): self {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt() {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials() {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Pedido[]
     */
    public function getPedidos(): Collection {
        return $this->pedidos;
    }

    public function addPedido(Pedido $pedido): self {
        if (!$this->pedidos->contains($pedido)) {
            $this->pedidos[] = $pedido;
            $pedido->setCliente($this);
        }

        return $this;
    }

    public function removePedido(Pedido $pedido): self {
        if ($this->pedidos->contains($pedido)) {
            $this->pedidos->removeElement($pedido);
            // set the owning side to null (unless already changed)
            if ($pedido->getCliente() === $this) {
                $pedido->setCliente(null);
            }
        }

        return $this;
    }

    public function getContactInfo(): ContactInfo {
        return $this->contactInfo;
    }

    public function setContactInfo(ContactInfo $contactInfo) {
        $this->contactInfo = $contactInfo;
        return $this;
    }

    /**
     * @return Collection|DireccionCliente[]
     */
    public function getDirecciones(): Collection
    {
        return $this->direcciones;
    }

    public function addDireccione(DireccionCliente $direccione): self
    {
        if (!$this->direcciones->contains($direccione)) {
            $this->direcciones[] = $direccione;
            $direccione->setCliente($this);
        }

        return $this;
    }

    public function removeDireccione(DireccionCliente $direccione): self
    {
        if ($this->direcciones->contains($direccione)) {
            $this->direcciones->removeElement($direccione);
            // set the owning side to null (unless already changed)
            if ($direccione->getCliente() === $this) {
                $direccione->setCliente(null);
            }
        }

        return $this;
    }

}
