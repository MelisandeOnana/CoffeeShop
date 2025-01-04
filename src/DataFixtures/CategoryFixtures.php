<?php
namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categoriesData = [
            'Espresso',
            'Latte',
            'Cappuccino',
            'Americano',
            'Mocha',
            'Macchiato',
            'Flat White',
            'Cold Brew',
            'Frappuccino',
            'Tea',
            'Hot Chocolate',
            'Chai Latte',
            'Matcha Latte',
            'Iced Coffee',
            'Affogato',
            'Turkish Coffee',
            'Irish Coffee',
            'Vietnamese Coffee',
            'Green Tea',
            'Black Tea'
        ];

        foreach ($categoriesData as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference('category_' . $categoryName, $category);
        }

        $manager->flush();
    }
}