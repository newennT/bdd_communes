<?php

namespace App\Form;

use App\Entity\Eveche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EvecheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', NumberType::class)
            ->add('nom_francais', TextType::class)
            ->add('nom_breton', TextType::class)
            ->add('nom_gallo', TextType::class)
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'tinymce'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Eveche::class,
        ]);
    }
}
