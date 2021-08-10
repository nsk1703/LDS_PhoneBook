<?php

namespace App\Controller;

use App\Entity\Coordinator;
use App\Form\CoordinatorType;
use App\Repository\CoordinatorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CoordinatorController extends AbstractController
{
    /**
     * @Route("/coordinators", name="app_coordinator_list", methods={"GET"})
     * @param CoordinatorRepository $coordinatorRepository
     * @return Response
     */
    public function index(CoordinatorRepository $coordinatorRepository): Response
    {
        $coordinators = $coordinatorRepository->findAll();

        return $this->render('coordinator/list_coordinators.html.twig', [
            'coordinators' => $coordinators,
        ]);
    }

    /**
     * @Route("/coordinator/create", name="app_coordinator_create", methods={"GET","POST"})
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $coordinator = new Coordinator();
        $form = $this->createForm(CoordinatorType::class, $coordinator);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($coordinator);
            $entityManager->flush();

            $this->addFlash('success','Coordinator successfully added!!');

            return $this->redirectToRoute('app_coordinator_list');
        }

        return $this->render('coordinator/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/coordinator/{id<[0-9]+>}", name="app_coordinator_show", methods={"GET"})
     */
    public function show(Coordinator $coordinator): Response
    {
        return $this->render('coordinator/show.html.twig', [
            'coordinator' => $coordinator,
        ]);
    }

    /**
     * @Route("/coordinator/{id<[0-9]+>}/edit", name="app_coordinator_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Coordinator $coordinator): Response
    {
        $form = $this->createForm(CoordinatorType::class, $coordinator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_coordinator_list');
        }

        return $this->render('coordinator/edit.html.twig', [
            'coordinator' => $coordinator,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param Coordinator $coordinator
     * @param EntityManagerInterface $entityManager
     * @Route("/coordinator/{id<[0-9]+>}/delete", name="app_coordinator_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Coordinator $coordinator, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('coordinator_deletion_'.$coordinator->getId(), $request->request->get('csrf_token')))
        {
            $entityManager->remove($coordinator);
            $entityManager->flush();

            $this->addFlash('info', 'Member successfully deleted!!');
        }

        return $this->redirectToRoute('app_coordinator_list');
    }
}
