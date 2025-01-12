<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Commune;
use App\Repository\CommuneRepository;
use App\Entity\Eveche;
use App\Repository\EvecheRepository;
use App\Entity\Pays;
use App\Repository\PaysRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', requirements: ['_locale' => 'fr|br|go'], defaults: ['_locale' => 'fr'])]
    public function index(CommuneRepository $communeRepository, EvecheRepository $evecheRepository, PaysRepository $paysRepository): Response
    {
        return $this->render('home/home.html.twig', [
            'communes' => $communeRepository->findAll(),
            'eveches' => $evecheRepository->findAll(),
            'pays' => $paysRepository->findAll(),
        ]);
    }

}
