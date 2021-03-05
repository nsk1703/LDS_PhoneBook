<?php

namespace App\Controller;

use App\Entity\Members;
use App\Form\MembersType;
use App\Repository\MembersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MembersController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     * @param MembersRepository $membersRepository
     * @return Response
     */
    public function index(MembersRepository $membersRepository): Response
    {
        $members = $membersRepository->findAll();
        return $this->render('members/index.html.twig', ['members' => $members]);
    }

    /**
     * @Route("/members/list", name="app_member_list", methods={"GET"})
     * @param MembersRepository $membersRepository
     * @return Response
     */
    public function listMembers(MembersRepository $membersRepository): Response
    {
        $members = $membersRepository->findAll();
        return $this->render("members/list_members.html.twig", ['members' => $members]);
    }

    /**
     * @Route("/member/create", name="app_member_create", methods={"GET", "POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $member = new Members();
        $form = $this->createForm(MembersType::class, $member);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($member);
            $entityManager->flush();

            $this->addFlash('success','Member successfully added!!');

            return $this->redirectToRoute("app_member_list");

        }

        return $this->render("members/create.html.twig", ['form' => $form->createView()]);
    }

    /**
     * @Route("/member/{id<[0-9]+>}", name="app_member_show", methods={"GET"})
     * @param Members $member
     * @return Response
     */
    public function show(Members $member): Response
    {
        return $this->render('members/show.html.twig', ['member' => $member]);
    }

    /**
     * @param Request $request
     * @param Members $member
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route("/member/{id<[0-9]+>}/edit", name="app_member_edit", methods={"GET", "PUT"})
     */
    public function edit(Request $request, Members $member, EntityManagerInterface $entityManager):Response
    {

        $form = $this->createForm(MembersType::class, $member, ['method' => 'PUT']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager->flush();
            $this->addFlash('success', 'Member successfully updated!!');

            return $this->redirectToRoute('app_member_list');

        }

        return $this->render('members/edit.html.twig',[
                'member' => $member,
                'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Members $member
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route("/member/{id<[0-9]+>}/delete", name="app_member_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Members $member, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('member_deletion_'.$member->getId(), $request->request->get('csrf_token')))
        {
            $entityManager->remove($member);
            $entityManager->flush();

            $this->addFlash('info', 'Member successfully deleted!!');
        }

        return $this->redirectToRoute('app_member_list');
    }
}
