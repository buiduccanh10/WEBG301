<?php

namespace App\Entity;

use App\Repository\ClassroomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassroomRepository::class)]
class Classroom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $class_id;

    #[ORM\Column(type: 'string', length: 255)]
    private $class_name;

    #[ORM\Column(type: 'string', length: 255)]
    private $class_status;

    #[ORM\ManyToMany(mappedBy: 'classroom', targetEntity: Student::class)]
    private $student_id;

    public function __construct()
    {
        $this->student_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassId(): ?string
    {
        return $this->class_id;
    }

    public function setClassId(string $class_id): self
    {
        $this->class_id = $class_id;

        return $this;
    }

    public function getClassName(): ?string
    {
        return $this->class_name;
    }

    public function setClassName(string $class_name): self
    {
        $this->class_name = $class_name;

        return $this;
    }

    public function getClassStatus(): ?string
    {
        return $this->class_status;
    }

    public function setClassStatus(string $class_status): self
    {
        $this->class_status = $class_status;

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getStudentId(): Collection
    {
        return $this->student_id;
    }

    public function addStudentId(Student $studentId): self
    {
        if (!$this->student_id->contains($studentId)) {
            $this->student_id[] = $studentId;
            $studentId->setClassroom($this);
        }

        return $this;
    }

    public function removeStudentId(Student $studentId): self
    {
        if ($this->student_id->removeElement($studentId)) {
            // set the owning side to null (unless already changed)
            if ($studentId->getClassroom() === $this) {
                $studentId->setClassroom(null);
            }
        }

        return $this;
    }
}
