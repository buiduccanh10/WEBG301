<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $student_id;

    #[ORM\Column(type: 'string', length: 255)]
    private $student_name;

    #[ORM\Column(type: 'date')]
    private $student_dob;

    #[ORM\Column(type: 'string', length: 255)]
    private $student_email;

    #[ORM\Column(type: 'string', length: 255)]
    private $student_address;

    #[ORM\Column(type: 'string', length: 255)]
    private $student_image;

    #[ORM\ManyToOne(targetEntity: Classroom::class, inversedBy: 'student_id')]
    private $classroom;

    #[ORM\ManyToMany(targetEntity: Grade::class, mappedBy: 'student_id')]
    private $grades;

    #[ORM\Column(type: 'string', length: 255)]
    private $Genre;

    public function __construct()
    {
        $this->grades = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudentId(): ?string
    {
        return $this->student_id;
    }

    public function setStudentId(string $student_id): self
    {
        $this->student_id = $student_id;

        return $this;
    }

    public function getStudentName(): ?string
    {
        return $this->student_name;
    }

    public function setStudentName(string $student_name): self
    {
        $this->student_name = $student_name;

        return $this;
    }

    public function getStudentDob(): ?\DateTimeInterface
    {
        return $this->student_dob;
    }

    public function setStudentDob(\DateTimeInterface $student_dob): self
    {
        $this->student_dob = $student_dob;

        return $this;
    }

    public function getStudentEmail(): ?string
    {
        return $this->student_email;
    }

    public function setStudentEmail(string $student_email): self
    {
        $this->student_email = $student_email;

        return $this;
    }

    public function getStudentAddress(): ?string
    {
        return $this->student_address;
    }

    public function setStudentAddress(string $student_address): self
    {
        $this->student_address = $student_address;

        return $this;
    }

    public function getStudentImage()
    {
        return $this->student_image;
    }

    public function setStudentImage( $student_image)
    {
        if($student_image !=null){
            $this->student_image = $student_image;
        }      
        return $this;
    }

    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?Classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }

    /**
     * @return Collection<int, Grade>
     */
    public function getGrades(): Collection
    {
        return $this->grades;
    }

    public function addGrade(Grade $grade): self
    {
        if (!$this->grades->contains($grade)) {
            $this->grades[] = $grade;
            $grade->addStudentId($this);
        }

        return $this;
    }

    public function removeGrade(Grade $grade): self
    {
        if ($this->grades->removeElement($grade)) {
            $grade->removeStudentId($this);
        }

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->Genre;
    }

    public function setGenre(string $Genre): self
    {
        $this->Genre = $Genre;

        return $this;
    }
}
