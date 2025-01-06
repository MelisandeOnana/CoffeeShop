<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand', EntityType::class, [
                'label' => 'Marque',
                'class' => Brand::class,
                'choice_label' => 'name',
                'required' => false,
                'placeholder' => 'Choisir une marque',
            ])
            ->add('category', EntityType::class, [
                'label' => 'Catégorie',
                'class' => Category::class,
                'choice_label' => 'name',
                'required' => false,
                'placeholder' => 'Choisir une catégorie',
            ])
            ->add('price_min', NumberType::class, [
                'required' => false,
                'label' => 'Prix minimum',
            ])
            ->add('price_max', NumberType::class, [
                'required' => false,
                'label' => 'Prix maximum',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
}