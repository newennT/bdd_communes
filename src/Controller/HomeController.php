<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Commune;
use App\Repository\CommuneRepository;
use App\Entity\Eveche;
use App\Repository\EvecheRepository;
use App\Entity\Pays;
use App\Repository\PaysRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', requirements: ['_locale' => 'fr|br|go'], defaults: ['_locale' => 'fr'])]
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
            50
        );

        return $this->render('home/home.html.twig', [
            'communes' => $communes,
            'communesPagination' => $communesPagination,
            'eveches' => $evecheRepository->findAll(),
            'pays' => $paysRepository->findAll(),
            'currentFilters' => [
                'pays' => $paysId,
                'eveche' => $evecheId,
            ],
        ]);
    }

    #[Route('/api/communes', name: 'api_communes', methods: ['GET'])]
    public function getCommunes(Request $request, CommuneRepository $communeRepository): Response
    {
        $paysId = $request->query->get('pays');
        $evecheId = $request->query->get('eveche');

        $queryBuilder = $communeRepository->createQueryBuilder('c');

        if ($paysId) {
            $queryBuilder->andWhere('c.id_pays = :paysId')
                        ->setParameter('paysId', $paysId);
        }

        if ($evecheId) {
            $queryBuilder->andWhere('c.id_eveche = :evecheId')
                        ->setParameter('evecheId', $evecheId);
        }

        $communes = $queryBuilder->getQuery()->getResult();

        $data = array_map(function ($commune) {
            return [
                'id' => $commune->getId(),
                'nomFrancais' => $commune->getNomFrancais(),
                'latitude' => $commune->getLatitude(),
                'longitude' => $commune->getLongitude(),
                'habitants' => $commune->getHabitants(),
            ];
        }, $communes);

        return $this->json($data);
    }

}
