<?php

namespace App\Controller;

use App\Entity\Commune;
use App\Repository\CommuneRepository;
use App\Entity\Eveche;
use App\Repository\EvecheRepository;
use App\Entity\Pays;
use App\Repository\PaysRepository;
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
    #[Route(name: 'app_commune_index', requirements: ['_locale' => 'fr|br|go'], defaults: ['_locale' => 'fr'], methods: ['GET'])]
    public function index(Request $request, CommuneRepository $communeRepository, EvecheRepository $evecheRepository, PaysRepository $paysRepository): Response
    {
        $paysId = $request->query->get('pays');
        $evecheId = $request->query->get('eveche');

        $queryBuilder = $communeRepository->createQueryBuilder('c')
            ->orderBy('c.code', 'ASC');

        if ($paysId) {
            $queryBuilder->andWhere('c.id_pays = :paysId')
                         ->setParameter('paysId', $paysId);
        }
    
        if ($evecheId) {
            $queryBuilder->andWhere('c.id_eveche = :evecheId')
                         ->setParameter('evecheId', $evecheId);
        }

        $communes = $queryBuilder->getQuery()->getResult();

        $communesPagination = Pagerfanta::createForCurrentPageWithMaxPerPage(
            new QueryAdapter($queryBuilder),
            $request->query->get('page', 1),
            90
        );

        return $this->render('commune/index.html.twig', [
            'communes' => $communes,
            'communesPagination' => $communesPagination,
            'eveches' => $evecheRepository->findAll(),
            'pays' => $paysRepository->findAll(),
            'currentFilters' => [
                'pays' => $paysId,
                'eveche' => $evecheId,
            ],
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
