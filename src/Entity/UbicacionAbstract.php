<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ORM\MappedSuperclass
 */
class UbicacionAbstract {
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $direccion;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $comuna;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $region;
    
    function getDireccion() {
        return $this->direccion;
    }

    function getComuna() {
        return $this->comuna;
    }

    function getRegion() {
        return $this->region;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
        return $this;
    }

    function setComuna($comuna) {
        $this->comuna = $comuna;
        return $this;
    }

    function setRegion($region) {
        $this->region = $region;
        return $this;
    }


    
}
