<?php

namespace App\Controller;

use App\Repository\CommuneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search', methods:['GET', 'POST'])]
    public function search(Request $request, CommuneRepository $communeRepository): Response
    {
         $query = $request->request->all('search')['query'];

         if ($query) {
            $communes = $communeRepository->findCommunesByName($query);
        } else {
            $communes = $communeRepository->createQueryBuilder('c');
        }



        return $this->render('search/index.html.twig', [
            'communes' => $communes,
            'query' => $query,
            'route_name' => 'app_search',
        ]);
    }

}