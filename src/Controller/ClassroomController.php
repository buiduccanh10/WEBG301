<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/classroom')]
class ClassroomController extends AbstractController
{
    #[Route('', name: 'classroom_index')]
    public function viewClass()
    {
        $classroom = $this->getDoctrine()->getRepository(Classroom::class)->findAll();
        return $this->renderForm('classroom/index.html.twig', [
            'classrooms' => $classroom
        ]);
    }

    #[Route('/add', name: 'classroom_add')]
    public function addClass(Request $request)
    {
        $classroom = new Classroom;
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($classroom);
            $manager->flush();
            return $this->redirectToRoute('classroom_index');
        }

        return $this->renderForm('classroom/add.html.twig', [         
            'form' => $form,
        ]);
    }

    #[Route('/detail/{id}', name: 'classroom_detail')]
    public function viewCLassbyid($id)
    {
        $classroom = $this->getDoctrine()->getRepository(Classroom::class)->find($id);
        if($classroom == null){
            $this->addFlash("Error", "Classroom not found !");
            return $this->redirectToRoute('classroom_index');
        }
        return $this->renderForm('classroom/detail.html.twig', [
            'classroom' => $classroom
        ]);
    }

    #[Route('/edit/{id}', name: 'classroom_edit')]
    public function editClass(Request $request, $id)
    {
        $classroom = $this->getDoctrine()->getRepository(Classroom::class)->find($id);   
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($classroom);
            $manager->flush();
            return $this->redirectToRoute('classroom_index');
        }

        return $this->renderForm('classroom/edit.html.twig', [
            'form' => $form,
        ]);   
    }

    #[Route('/delete/{id}', name: 'classroom_delete')]
    public function deleteClass($id)
    {
        $classroom = $this->getDoctrine()->getRepository(Classroom::class)->find($id);
        if($classroom == null){
            $this->addFlash("Error", "Classroom not found !");     
        }
        
        else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($classroom);
            $manager->flush();
            $this->addFlash("Success", "Classroom deleted !");
        }
        return $this->redirectToRoute('classroom_index');
    }
    #[Route('/asc', name: 'sort_asc_classroom')]
    public function sortAsc(ClassroomRepository $classroomRepository)
    {
        $classroom = $classroomRepository->sortTitleAscending();
        return $this->renderForm('classroom/index.html.twig', [
            'classrooms' => $classroom
        ]);
    }
    #[Route('/desc', name: 'sort_desc_classroom')]
    public function sortDesc(ClassroomRepository $classroomRepository)
    {
        $classroom = $classroomRepository->sortTitleDescending();
        return $this->renderForm('classroom/index.html.twig', [
            'classrooms' => $classroom
        ]);
    }
}
