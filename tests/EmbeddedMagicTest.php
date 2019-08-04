<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\Cliente;
use Doctrine\ORM\EntityManager;

class EmbeddedMagicTest extends KernelTestCase {

    /**
     *
     * @var EntityManager
     */
    private $em;

    protected function setUp(): void {
        $kernel = self::bootKernel();
        $this->em = $kernel
                ->getContainer()
                ->get('doctrine')
                ->getManager()
        ;
        $this->em->createQuery('DELETE App\Entity\Cliente c')->execute();
    }

    protected function tearDown(): void {
        parent::tearDown();
        $this->em->close();
        $this->em = null; // avoid memory leaks
    }

    public function testMagic() {
        $cliente = (new Cliente())
                ->setEmail('asdf@asdf.cl')
                ->setPassword('1234')
                ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
        ;
        $cliente
                ->setNombre('Juanito')
                ->setApellido('Pérez')
                ->setTelefono('9 9111 2222')
        ;
        $this->em->persist($cliente);
        $this->em->flush();
    }

}
