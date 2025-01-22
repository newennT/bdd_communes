<?php

namespace App\Form;

use App\Entity\Eveche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class EvecheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_francais', TextType::class, [
                'label' => 'Nom français',
            ])
            ->add('nom_breton', TextType::class)
            ->add('nom_gallo', TextType::class, [
                'required' => false,
            ])
            ->add('imageUrl', FileType::class, [
                'required' => false,
                'mapped' => false,
                'label' => 'Image',
                'attr' => [
                    'accept' => 'image/png, image/jpeg',
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file (JPEG or PNG).',
                    ]),
                ],
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'tinymce'],
                'required' => false,
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
