<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Twig\Environment;
use App\Form\SearchType;

class SearchFormSubscriber implements EventSubscriberInterface
{
    private FormFactoryInterface $formFactory;
    private Environment $twig;

    public function __construct(FormFactoryInterface $formFactory, Environment $twig)
    {
        $this->formFactory = $formFactory;
        $this->twig = $twig;
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $form = $this->formFactory->create(SearchType::class);
        $this->twig->addGlobal('form', $form->createView());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}