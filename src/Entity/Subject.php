<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubjectRepository::class)]
class Subject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $subject_id;

    #[ORM\Column(type: 'string', length: 255)]
    private $subject_name;

    #[ORM\Column(type: 'string', length: 255)]
    private $subject_teacher;

    #[ORM\ManyToOne(targetEntity: Grade::class, inversedBy: 'subject_id')]
    private $grade;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubjectId(): ?string
    {
        return $this->subject_id;
    }

    public function setSubjectId(string $subject_id): self
    {
        $this->subject_id = $subject_id;

        return $this;
    }

    public function getSubjectName(): ?string
    {
        return $this->subject_name;
    }

    public function setSubjectName(string $subject_name): self
    {
        $this->subject_name = $subject_name;

        return $this;
    }

    public function getSubjectTeacher(): ?string
    {
        return $this->subject_teacher;
    }

    public function setSubjectTeacher(string $subject_teacher): self
    {
        $this->subject_teacher = $subject_teacher;

        return $this;
    }

    public function getGrade(): ?Grade
    {
        return $this->grade;
    }

    public function setGrade(?Grade $grade): self
    {
        $this->grade = $grade;

        return $this;
    }
}
