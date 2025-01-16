<?php

namespace App\Controller;

use App\Repository\CommuneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Doctrine\ORM\QueryAdapter;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search', methods:['GET', 'POST'])]
    public function search(Request $request, CommuneRepository $communeRepository): Response
    {
         $query = $request->request->all('search')['query'];

         if ($query) {
            $queryBuilder = $communeRepository->findCommunesByName($query);
        } else {
            $queryBuilder = $communeRepository->createQueryBuilder('c');
        }

        $communesPagination = Pagerfanta::createForCurrentPageWithMaxPerPage(
            new QueryAdapter($queryBuilder), 
            $request->query->get('page', 1), 
            20 
        );

        return $this->render('search/index.html.twig', [
            'communesPagination' => $communesPagination,
            'query' => $query,
            'route_name' => 'app_search',
        ]);
    }

}