<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LocaleController extends AbstractController
{
    #[Route('/locale-not-available', name: 'locale_not_available', methods: ['GET'])]
    public function localeNotAvailable(): Response
    {
        return $this->render('locale/not_available.html.twig', [
            'message' => 'La traduction pour le gallo n\'est pas encore disponible.',
        ]);
    }
}