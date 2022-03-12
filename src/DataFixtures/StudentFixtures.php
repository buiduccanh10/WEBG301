<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<=10;$i++){
         $student = new Student();
            $student->setStudentId('S01');
            $student->setStudentName('John');
            $student->setGenre('Male');
            $student->setStudentDob(\DateTime::createFromFormat('Y/m/d','1995/07/15'));
            $student->setStudentEmail('@gmail.com');
            $student->setStudentAddress('Kathmandu');
            $student->setStudentImage('https://www.eurocircuits.com/wp-content/uploads/Student-icon.jpg');
            $manager->persist($student);
        } 
          $manager->flush();
    }
}
