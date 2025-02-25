<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;
use App\Repository\CommuneRepository;
use App\Repository\PaysRepository;
use App\Repository\EvecheRepository;

class SitemapController extends AbstractController
{    
    private $twig;
    private $router;

    public function __construct(Environment $twig, UrlGeneratorInterface $router)
    {
        $this->twig = $twig;
        $this->router = $router;
    }
    
    #[Route('/sitemap.xml', name: 'sitemap', defaults: ['_format' => 'xml'])]
    public function index(CommuneRepository $communeRepository, PaysRepository $paysRepository, EvecheRepository $evecheRepository): Response
    {
        $urls = [
            ['loc' => $this->router->generate('app_home', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => new \DateTime()],
            ['loc' => $this->router->generate('app_commune_index', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => new \DateTime()],
            ['loc' => $this->router->generate('app_eveche_index', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => new \DateTime()],
            ['loc' => $this->router->generate('app_pays_index', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => new \DateTime()],
        ];

        $communes = $communeRepository->findAll();

        foreach ($communes as $commune) {
            $urls[] = ['loc' => $this->router->generate('app_commune_show', ['id' => $commune->getId()], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => new \DateTime()];
        }

        $eveches = $evecheRepository->findAll();

        foreach ($eveches as $eveche) {
            $urls[] = ['loc' => $this->router->generate('app_eveche_show', ['id' => $eveche->getId()], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => new \DateTime()];
        }

        $pays = $paysRepository->findAll();

        foreach ($pays as $pay) {
            $urls[] = ['loc' => $this->router->generate('app_pays_show', ['id' => $pay->getId()], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => new \DateTime()];
        }

        $response = new Response(
            $this->twig->render('sitemap/index.xml.twig', ['urls' => $urls]),
            Response::HTTP_OK
        );

        $response->headers->set('Content-Type', 'application/xml');
        
        return $response;
    }
}