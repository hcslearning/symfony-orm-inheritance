<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManager;
use App\Entity\Cliente;
use App\Entity\Empresa;
use App\Entity\DireccionEmpresa;

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
        $this->em->createQuery('DELETE App\Entity\Cliente')->execute();
        $this->em->createQuery('DELETE App\Entity\Empresa')->execute();
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

    public function testInheritance() {
        $empresa = (new Empresa())
                ->setAlias("jumbo")
                ->setRazonSocial("CENCOSUD S.A.")
                ->setDireccion(
                    (new DireccionEmpresa())
                        ->setComuna('Las Condes')
                        ->setDireccion("Manquehue Norte 122")
                        ->setRegion("RM")
                        ->setTipo("OFICINA")
                )
        ;
        $this->em->persist($empresa);
        $this->em->flush();
        
        $repository = $this->em->getRepository(Empresa::class);
        $cencosud = $repository->findOneBy(['alias' => 'jumbo']);
        $this->assertNotNull($cencosud);
        print_r($cencosud);
    }

}
