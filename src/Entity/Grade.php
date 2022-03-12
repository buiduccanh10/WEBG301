<?php

namespace App\Entity;

use App\Repository\GradeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GradeRepository::class)]
class Grade
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $grade_id;

    #[ORM\Column(type: 'float')]
    private $grade_result;

    #[ORM\OneToMany(mappedBy: 'grade', targetEntity: Subject::class)]
    private $subject_id;

    #[ORM\ManyToMany(targetEntity: Student::class, inversedBy: 'grades')]
    private $student_id;

    public function __construct()
    {
        $this->subject_id = new ArrayCollection();
        $this->student_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGradeId(): ?int
    {
        return $this->grade_id;
    }

    public function setGradeId(int $grade_id): self
    {
        $this->grade_id = $grade_id;

        return $this;
    }

    public function getGradeResult(): ?float
    {
        return $this->grade_result;
    }

    public function setGradeResult(float $grade_result): self
    {
        $this->grade_result = $grade_result;

        return $this;
    }

    /**
     * @return Collection<int, Subject>
     */
    public function getSubjectId(): Collection
    {
        return $this->subject_id;
    }

    public function addSubjectId(Subject $subjectId): self
    {
        if (!$this->subject_id->contains($subjectId)) {
            $this->subject_id[] = $subjectId;
            $subjectId->setGrade($this);
        }

        return $this;
    }

    public function removeSubjectId(Subject $subjectId): self
    {
        if ($this->subject_id->removeElement($subjectId)) {
            // set the owning side to null (unless already changed)
            if ($subjectId->getGrade() === $this) {
                $subjectId->setGrade(null);
            }
        }

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
        }

        return $this;
    }

    public function removeStudentId(Student $studentId): self
    {
        $this->student_id->removeElement($studentId);

        return $this;
    }
}
