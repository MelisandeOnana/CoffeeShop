<?php
namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $brandsData = [
           'Starbucks',
            'Costa Coffee',
            'Dunkin\' Donuts',
            'Peet\'s Coffee',
            'Tim Hortons',
            'Caribou Coffee',
            'Lavazza',
            'Nespresso',
            'Illy',
            'Gloria Jean\'s Coffees',
            'Blue Bottle Coffee',
            'Stumptown Coffee Roasters',
            'Philz Coffee',
            'Dutch Bros Coffee',
            'The Coffee Bean & Tea Leaf'
        ];

        foreach ($brandsData as $brandName) {
            $brand = new Brand();
            $brand->setName($brandName);
            $manager->persist($brand);
            $this->addReference('brand_' . $brandName, $brand);
        }

        $manager->flush();
    }
}