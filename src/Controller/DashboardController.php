<?php

namespace App\Controller;

use App\Repository\CoordinatorRepository;
use App\Repository\MembersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     * @param MembersRepository $membersRepository
     * @param CoordinatorRepository $coordinatorRepository
     * @return Response
     */
    public function index(MembersRepository $membersRepository, CoordinatorRepository $coordinatorRepository): Response
    {
        $members = $membersRepository->findAll();
        $coordinators = $coordinatorRepository->findAll();

        return $this->render('dashboard.html.twig', [
            'members' => $members,
            'coordinators' =>  $coordinators
        ]);
    }
}
