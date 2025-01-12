<?php 
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RedirectController extends AbstractController
{
    #[Route('/', name: 'redirect_to_locale')]
    public function redirectToLocale(): RedirectResponse
    {
        return $this->redirectToRoute('app_home', ['_locale' => 'fr']);
    }
}