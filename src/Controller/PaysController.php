<?php

namespace App\Controller;

use App\Entity\Pays;
use App\Form\PaysType;
use App\Repository\PaysRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

#[Route('/pays')]
final class PaysController extends AbstractController
{
    #[Route(name: 'app_pays_index', methods: ['GET'])]
    public function index(PaysRepository $paysRepository): Response
    {
        return $this->render('pays/index.html.twig', [
            'pays' => $paysRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_pays_show', methods: ['GET'])]
    public function show(Request $request, Pays $pay, EntityManagerInterface $entityManager): Response
    {
        $queryBuilder = $entityManager->createQueryBuilder()
            ->select('commune')
            ->from('App\Entity\Commune', 'commune')
            ->where('commune.id_pays = :pays')
            ->setParameter('pays', $pay)
            ->orderBy('commune.code', 'ASC');

        $communesPagination = Pagerfanta::createForCurrentPageWithMaxPerPage(
                new QueryAdapter($queryBuilder),
                $request->query->get('page', 1),
                50
            );

        return $this->render('pays/show.html.twig', [
            'pay' => $pay,
            'communesPagination' => $communesPagination,
        ]);
    }

}
