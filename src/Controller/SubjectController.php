<?php

namespace App\Controller;

use App\Entity\Subject;
use App\Form\SubjectType;
use App\Repository\SubjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/subject')]
class SubjectController extends AbstractController
{
    #[Route('', name: 'subject_index')]
    public function viewClass()
    {
        $subject = $this->getDoctrine()->getRepository(Subject::class)->findAll();
        return $this->renderForm('subject/index.html.twig', [
            'subjects' => $subject
        ]);
    }

    #[Route('/add', name: 'subject_add')]
    public function new(Request $request)
    {
        $subject = new Subject;
        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($subject);
            $manager->flush();
            return $this->redirectToRoute('subject_index');
        }

        return $this->renderForm('subject/add.html.twig', [
            'form' => $form,
        ]);
    }
  
    #[Route('/detail/{id}', name: 'subject_detail')]
    public function viewSubjectbyid(Subject $subject)
    {
        $subject=$this -> getDoctrine() -> getRepository(Subject::class) -> find($subject);
        if($subject == null){
            $this->addFlash("Error", "Subject not found !");
            return $this->redirectToRoute('subject_index');
        }
        return $this->renderForm('subject/detail.html.twig', [
            'subject' => $subject
        ]);
    }

    #[Route('/edit/{id}', name: 'subject_edit')]
    public function editClass(Request $request, $id)
    {
        $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);   
        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($subject);
            $manager->flush();
            return $this->redirectToRoute('subject_index');
        }

        return $this->renderForm('subject/edit.html.twig', [
            'form' => $form,
        ]);
    }
    
    #[Route('/delete/{id}', name: 'subject_delete')]
    public function deleteClass($id)
    {
        $subject = $this -> getDoctrine() -> getRepository(Subject::class) -> find($id);
        if($subject == null){
            $this->addFlash("Error", "Subject not found !");     
        }
        else{
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($subject);
            $manager->flush();
            $this->addFlash("Success", "Subject deleted !");
        }
        return $this->redirectToRoute('subject_index');
    }
}
