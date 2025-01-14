<?php

namespace App\Form;

use App\Entity\Commune;
use App\Entity\Eveche;
use App\Entity\Pays;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CommuneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', NumberType::class)
            ->add('code', NumberType::class)
            ->add('nom_francais', TextType::class)
            ->add('nom_breton', TextType::class)
            ->add('nom_gallo', TextType::class)
            ->add('habitants', NumberType::class)
            ->add('latitude', NumberType::class)
            ->add('longitude', NumberType::class)
            ->add('id_eveche', EntityType::class, [
                'class' => Eveche::class,
                'choice_label' => 'id',
            ])
            ->add('id_pays', EntityType::class, [
                'class' => Pays::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commune::class,
        ]);
    }
}
