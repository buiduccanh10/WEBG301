<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function PHPUnit\Framework\throwException;

#[Route('/student')]
class StudentController extends AbstractController
{
    #[Route('', name: 'student_index')]
    public function viewStudent()
    {
        $student = $this->getDoctrine()->getRepository(Student::class)->findAll();
        return $this->renderForm('student/index.html.twig', [
            'students' => $student
        ]);
    }

    #[Route('/detail/{id}', name: 'student_detail')]
    public function viewStudentbyid($id)
    {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        if ($student == null) {
            $this->addFlash("Error", "Student not found !");         
            return $this->redirectToRoute('student_index');
        }
        return $this->renderForm('student/detail.html.twig', [
            'student' => $student
        ]);
    }
    
    #[Route('/add', name: 'student_add')]
    public function addStudent(Request $request)
    {
        $student = new Student;
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $image= $student->getStudentImage();
            $imgName =uniqid();
            $imgExt = $image->guessExtension();
            $imgfullName=$imgName.'.'.$imgExt;
            try {
                $image->move(
                    $this->getParameter('student_cover'),
                    $imgfullName
                );
            } catch (FileException $e) {
                throwException($e);
            }
            $student->setStudentImage($imgfullName);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($student);
            $manager->flush();
            return $this->redirectToRoute('student_index');
        }
        return $this->renderForm('student/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/edit/{id}', name: 'student_edit')]
    public function editStudent(Request $request,$id)
    {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file =$form['student_image']->getData();
            if($file!=null){
                $image= $student->getStudentImage();
                $imgName =uniqid();
                $imgExt = $image->guessExtension();
                $imgfullName=$imgName.'.'.$imgExt;
                try {
                    $image->move(
                        $this->getParameter('student_cover'),
                        $imgfullName
                    );
                } catch (FileException $e) {
                    throwException($e);
                }
                $student->setStudentImage($imgfullName);
            }
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($student);
            $manager->flush();
            return $this->redirectToRoute('student_index');
        }
        return $this->renderForm('student/edit.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/delete/{id}', name: 'student_delete')]
    public function deleteStudent($id)
    {
        $student=$this->getDoctrine()->getRepository(Student::class)->find($id);
        if($student==null){
            $this->addFlash("Error", "Student not found !");         
        }else{
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($student);
            $manager->flush();
            $this->addFlash("Success", "Student deleted !");
        }
        return $this->redirectToRoute('student_index');
    }
    #[Route('/asc', name: 'sort_asc')]
    public function sortAsc(StudentRepository $studentRepository)
    {
        $students = $studentRepository->sortTitleAscending();
        return $this->renderForm('student/index.html.twig', [
            'students' => $students
        ]);
    }
    #[Route('/desc', name: 'sort_desc')]
    public function sortDesc(StudentRepository $studentRepository)
    {
        $students = $studentRepository->sortTitleDescending();
        return $this->renderForm('student/index.html.twig', [
            'students' => $students
        ]);
    }
    #[Route('/search', name: 'search_student')]
    public function searchStudent(Request $request,StudentRepository $studentRepository)
    {
        $name = $request->query->get('word');
        $students = $studentRepository->searchStudent($name);
        return $this->renderForm('student/index.html.twig', [
            'students' => $students
        ]);
    }  
}
