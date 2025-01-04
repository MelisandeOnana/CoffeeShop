<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom du produit',
                'attr' => ['class' => 'block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500']
            ])
            ->add('price', null, [
                'label' => 'Prix',
                'attr' => ['class' => 'block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500']
            ])
            ->add('category', null, [
                'label' => 'Catégorie',
                'attr' => ['class' => 'block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500']
            ])
            ->add('brand', null, [
                'label' => 'Marque',
                'attr' => ['class' => 'block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500']
            ])
            ->add('image', FileType::class, [
                'label' => 'Image (fichier JPG, PNG)',
                'mapped' => false,
                'required' => false,
                'attr' => ['class' => 'block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500']
            ])
            ->add('note', null, [
                'label' => 'Note',
                'attr' => ['class' => 'block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500']
            ])
            ->add('country', null, [
                'label' => 'Pays',
                'attr' => ['class' => 'block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500']
            ])
            ->add('family', null, [
                'label' => 'Famille',
                'attr' => ['class' => 'block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500']
            ])
            ->add('bestSeller', null, [
                'label' => 'Meilleure vente',
                'attr' => ['class' => 'block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}