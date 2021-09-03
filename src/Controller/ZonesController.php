<?php

namespace App\Controller;

use App\Entity\Zones;
use App\Form\ZonesType;
use App\Repository\MembersRepository;
use App\Repository\ZonesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ZonesController extends AbstractController
{
    /**
     * @Route("/zones", name="app_zone_list", methods={"GET"})
     */
    public function index(ZonesRepository $zonesRepository): Response
    {
        return $this->render('zones/list_zones.html.twig', [
            'zones' => $zonesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/zone/create", name="app_zone_create", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $zone = new Zones();
        $form = $this->createForm(ZonesType::class, $zone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($zone);
            $entityManager->flush();

            return $this->redirectToRoute('app_zone_list');
        }

        return $this->render('zones/create.html.twig', [
            'zone' => $zone,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/zone/{zone<[0-9]+>}", name="app_zone_show", methods={"GET"})
     */
    public function show(Zones $zone, MembersRepository $membersRepository): Response
    {
        $members = $membersRepository->byZone($zone);
        return $this->render('zones/show.html.twig', [
            'zone' => $zone,
            'members' => $members
        ]);
    }

    /**
     * @Route("/zone/{id<[0-9]+>}/edit", name="app_zone_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Zones $zone): Response
    {
        $form = $this->createForm(ZonesType::class, $zone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_zone_list');
        }

        return $this->render('zones/edit.html.twig', [
            'zone' => $zone,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param Zones $zone
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route("/zone/{id<[0-9]+>}/delete", name="app_zone_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Zones $zone, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('zone_deletion_'.$zone->getId(), $request->request->get('csrf_token')))
        {
            $entityManager->remove($zone);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_zone_list');
    }
}
