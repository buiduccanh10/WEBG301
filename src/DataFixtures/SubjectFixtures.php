<?php

namespace App\DataFixtures;

use App\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $subject = new Subject();
            $subject->setSubjectId('S01');
            $subject->setSubjectName('PHP');
            $subject->setSubjectTeacher('Mr. John');
         $manager->persist($subject);

        $manager->flush();
    }
}
