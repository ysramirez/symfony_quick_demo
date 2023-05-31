<?php

namespace App\DataFixtures;

use App\Entity\Empleado;
use App\Entity\Oficina;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $oficina1 = new Oficina();
        $oficina1->setNombre('Recursos Humanos');
        $manager->persist($oficina1);

        $oficina2 = new Oficina();
        $oficina2->setNombre('Administración');
        $manager->persist($oficina2);

        for ($i = 1; $i < 20; $i++) {
            $manager->persist($this->createEmpleado($i<10 ? $oficina1:$oficina2, $i));
        }

        $manager->flush();
    }

    private function createEmpleado(Oficina $oficina, int $i): Empleado
    {
        $empleado = new Empleado();
        $empleado->setNombre('Nombre ' . $i);
        $empleado->setApellido('Apellido ' . $i);
        $empleado->setEdad(rand(18, 100));
        $empleado->setCorreo('correo' . $i . '@gmail.com');
        $empleado->setTelefono('123-456-789'.$i);
        $empleado->setDireccion('Dirección ' . $i);

        $empleado->setOficina($oficina);

        return $empleado;
    }
}
