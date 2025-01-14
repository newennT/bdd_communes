<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;
use App\Service\SearchFormProvider;

class SearchFormSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $searchFormProvider;

    public function __construct(Environment $twig, SearchFormProvider $searchFormProvider)
    {
        $this->twig = $twig;
        $this->searchFormProvider = $searchFormProvider;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();

        if (is_array($controller)) {
            $this->twig->addGlobal('form', $this->searchFormProvider->getSearchForm());
        }    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}