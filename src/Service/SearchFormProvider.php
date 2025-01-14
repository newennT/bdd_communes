<?php

namespace App\Service;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchFormProvider
{
    private $formFactory;
    private $router;

    public function __construct(FormFactoryInterface $formFactory, RouterInterface $router)
    {
        $this->formFactory = $formFactory;
        $this->router = $router;
    }

    public function getSearchForm()
    {
        return $this->formFactory->createBuilder()
            ->setAction($this->router->generate('app_search'))
            ->setMethod('POST')
            ->add('query', TextType::class, [
                'label' => false,
                'attr' => ['class' => 'form-control search-query', 'placeholder' => 'Rechercher...'],
            ])

            ->getForm()
            ->createView();
    }
}