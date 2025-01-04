<?php

namespace App\DataFixtures;

use App\Entity\Slider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SliderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $slidersData = [
            ['title' => 'Bienvenue dans notre café', 'content' => 'Découvrez le meilleur café en ville.', 'button_link' => '/shop', 'button_text' => 'Achetez maintenant', 'message' => 'Profitez de nos offres spéciales !'],
            ['title' => 'Café fraîchement préparé', 'content' => 'Découvrez le goût du café fraîchement préparé.', 'button_link' => '/about', 'button_text' => 'En savoir plus', 'message' => 'Visitez-nous dès aujourd\'hui !'],
        ];

        foreach ($slidersData as $data) {
            $slider = new Slider();
            $slider->setTitle($data['title']);
            $slider->setContent($data['content']);
            $slider->setButtonLink($data['button_link']);
            $slider->setButtonText($data['button_text']);

            $manager->persist($slider);
        }

        $manager->flush();
    }
}