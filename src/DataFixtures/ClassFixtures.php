<?php

namespace App\DataFixtures;

use App\Entity\Classroom;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClassFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $class = new Classroom();
            $class->setClassId('C01');
            $class->setClassName('PHP');
            $class->setClassStatus('Active');
         $manager->persist($class);

        $manager->flush();
    }
}
