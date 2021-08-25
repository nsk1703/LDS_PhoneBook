<?php

namespace App\Controller;

use App\Repository\CoordinatorRepository;
use App\Repository\MembersRepository;
use App\Repository\ZonesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     * @param MembersRepository $membersRepository
     * @param ZonesRepository $zoneRepository
     * @param CoordinatorRepository $coordinatorRepository
     * @return Response
     */
    public function index(MembersRepository $membersRepository, CoordinatorRepository $coordinatorRepository,
                         ZonesRepository $zoneRepository): Response
    {
        $members = $membersRepository->findAll();
        $coordinators = $coordinatorRepository->findAll();
        $zones = $zoneRepository->findAll();

        return $this->render('dashboard.html.twig', [
            'members' => $members,
            'coordinators' =>  $coordinators,
            'zones' => $zones
        ]);
    }
}
