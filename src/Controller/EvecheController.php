<?php

namespace App\Controller;

use App\Entity\Eveche;
use App\Form\EvecheType;
use App\Repository\EvecheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

#[Route('/eveche')]
final class EvecheController extends AbstractController
{
    #[Route(name: 'app_eveche_index', methods: ['GET'])]
    public function index(EvecheRepository $evecheRepository): Response
    {
        return $this->render('eveche/index.html.twig', [
            'eveches' => $evecheRepository->findAll(),
        ]);
    }

    
    #[Route('/{id}', name: 'app_eveche_show', methods: ['GET'])]
    public function show(Request $request, Eveche $eveche, EntityManagerInterface $entityManager): Response
    {
        $communes = $entityManager->createQueryBuilder()
            ->select('commune')
            ->from('App\Entity\Commune', 'commune')
            ->where('commune.id_eveche = :eveche')
            ->setParameter('eveche', $eveche)
            ->orderBy('commune.code', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('eveche/show.html.twig', [
            'eveche' => $eveche,
            'communes' => $communes,
        ]);
    }


}
