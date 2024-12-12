<?php

namespace App\Form;

use App\Entity\Commune;
use App\Entity\Eveche;
use App\Entity\Pays;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommuneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id')
            ->add('nom_francais')
            ->add('nom_breton')
            ->add('nom_gallo')
            ->add('habitants')
            ->add('latitude')
            ->add('longitude')
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
