<?php

namespace App\DataFixtures;

use App\Entity\Grade;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GradeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $grade = new Grade();
            $grade->setGradeId('01');
            $grade->setGradeResult('6.75');
         $manager->persist($grade);

        $manager->flush();
    }
}
