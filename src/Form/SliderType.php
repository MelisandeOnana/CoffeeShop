<?php

namespace App\Form;

use App\Entity\Slider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class SliderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 255]),
                ],
                'attr' => ['class' => 'block w-full mt-1 border border-gray-300 focus:border-brown-500 focus:ring-brown-500 rounded-lg shadow-sm p-2'],
            ])
            ->add('content', TextType::class, [
                'label' => 'Contenu',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 255]),
                ],
                'attr' => ['class' => 'block w-full mt-1 border border-gray-300 focus:border-brown-500 focus:ring-brown-500 rounded-lg shadow-sm p-2'],
            ])
            ->add('buttonText', TextType::class, [
                'label' => 'Titre du bouton',
                'required' => false,
                'constraints' => [
                    new Assert\Length(['max' => 30]),
                ],
                'attr' => ['class' => 'block w-full mt-1 border border-gray-300 focus:border-brown-500 focus:ring-brown-500 rounded-lg shadow-sm p-2'],
            ])
            ->add('buttonLink', TextType::class, [
                'label' => 'Lien du bouton',
                'required' => false,
                'constraints' => [
                    new Assert\Length(['max' => 255]),
                ],
                'attr' => ['class' => 'block w-full mt-1 border border-gray-300 focus:border-brown-500 focus:ring-brown-500 rounded-lg shadow-sm p-2'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Slider::class,
        ]);
    }
}