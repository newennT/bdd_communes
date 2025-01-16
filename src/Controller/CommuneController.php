<?php

namespace App\Controller;

use App\Entity\Commune;
use App\Repository\CommuneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

#[Route('/commune')]
final class CommuneController extends AbstractController
{
    #[Route(name: 'app_commune_index', methods: ['GET'])]
    public function index(Request $request, CommuneRepository $communeRepository): Response
    {
        $queryBuilder = $communeRepository->createQueryBuilder('c')
            ->orderBy('c.code', 'ASC');

        $communesPagination = Pagerfanta::createForCurrentPageWithMaxPerPage(
            new QueryAdapter($queryBuilder),
            $request->query->get('page', 1),
            60
        );

        return $this->render('commune/index.html.twig', [
            'communes' => $communesPagination,
            'route_name' => 'app_commune_index',
        ]);
    }

    #[Route('/{id}', name: 'app_commune_show', methods: ['GET'])]
    public function show(Commune $commune): Response
    {
        return $this->render('commune/show.html.twig', [
            'commune' => $commune,
        ]);
    }

  }
