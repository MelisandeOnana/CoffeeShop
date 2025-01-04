<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $productsData = [
            ['name' => 'Espresso', 'price' => 2.50, 'category' => 'Espresso', 'brand' => 'Starbucks', 'image' => 'espresso.jpg', 'note' => 5, 'country' => 'Italy', 'family' => 'Coffee', 'bestSeller' => true],
            ['name' => 'Latte', 'price' => 3.50, 'category' => 'Latte', 'brand' => 'Costa Coffee', 'image' => 'latte.jpg', 'note' => 4, 'country' => 'Italy', 'family' => 'Coffee', 'bestSeller' => false],
            ['name' => 'Cappuccino', 'price' => 3.00, 'category' => 'Cappuccino', 'brand' => 'Dunkin\' Donuts', 'image' => 'cappuccino.jpg', 'note' => 4, 'country' => 'Italy', 'family' => 'Coffee', 'bestSeller' => true],
            ['name' => 'Americano', 'price' => 2.75, 'category' => 'Americano', 'brand' => 'Peet\'s Coffee', 'image' => 'americano.jpg', 'note' => 3, 'country' => 'USA', 'family' => 'Coffee', 'bestSeller' => false],
            ['name' => 'Mocha', 'price' => 3.75, 'category' => 'Mocha', 'brand' => 'Tim Hortons', 'image' => 'mocha.jpg', 'note' => 5, 'country' => 'USA', 'family' => 'Coffee', 'bestSeller' => true],
            ['name' => 'Macchiato', 'price' => 3.25, 'category' => 'Macchiato', 'brand' => 'Caribou Coffee', 'image' => 'macchiato.jpg', 'note' => 4, 'country' => 'Italy', 'family' => 'Coffee', 'bestSeller' => false],
            ['name' => 'Flat White', 'price' => 3.50, 'category' => 'Flat White', 'brand' => 'Lavazza', 'image' => 'flat_white.jpg', 'note' => 4, 'country' => 'Australia', 'family' => 'Coffee', 'bestSeller' => true],
            ['name' => 'Cold Brew', 'price' => 4.00, 'category' => 'Cold Brew', 'brand' => 'Nespresso', 'image' => 'cold_brew.jpg', 'note' => 5, 'country' => 'USA', 'family' => 'Coffee', 'bestSeller' => false],
            ['name' => 'Frappuccino', 'price' => 4.50, 'category' => 'Frappuccino', 'brand' => 'Illy', 'image' => 'frappuccino.jpg', 'note' => 5, 'country' => 'USA', 'family' => 'Coffee', 'bestSeller' => true],
            ['name' => 'Tea', 'price' => 2.00, 'category' => 'Tea', 'brand' => 'Gloria Jean\'s Coffees', 'image' => 'tea.jpg', 'note' => 3, 'country' => 'China', 'family' => 'Tea', 'bestSeller' => false],
            ['name' => 'Hot Chocolate', 'price' => 3.00, 'category' => 'Hot Chocolate', 'brand' => 'Starbucks', 'image' => 'hot_chocolate.jpg', 'note' => 4, 'country' => 'USA', 'family' => 'Chocolate', 'bestSeller' => true],
            ['name' => 'Chai Latte', 'price' => 3.50, 'category' => 'Chai Latte', 'brand' => 'Costa Coffee', 'image' => 'chai_latte.jpg', 'note' => 4, 'country' => 'India', 'family' => 'Tea', 'bestSeller' => false],
            ['name' => 'Matcha Latte', 'price' => 4.00, 'category' => 'Matcha Latte', 'brand' => 'Dunkin\' Donuts', 'image' => 'matcha_latte.jpg', 'note' => 5, 'country' => 'Japan', 'family' => 'Tea', 'bestSeller' => true],
            ['name' => 'Iced Coffee', 'price' => 3.00, 'category' => 'Iced Coffee', 'brand' => 'Peet\'s Coffee', 'image' => 'iced_coffee.jpg', 'note' => 4, 'country' => 'USA', 'family' => 'Coffee', 'bestSeller' => false],
            ['name' => 'Affogato', 'price' => 4.50, 'category' => 'Affogato', 'brand' => 'Tim Hortons', 'image' => 'affogato.jpg', 'note' => 5, 'country' => 'Italy', 'family' => 'Coffee', 'bestSeller' => true],
            ['name' => 'Turkish Coffee', 'price' => 3.25, 'category' => 'Turkish Coffee', 'brand' => 'Caribou Coffee', 'image' => 'turkish_coffee.jpg', 'note' => 4, 'country' => 'Turkey', 'family' => 'Coffee', 'bestSeller' => false],
            ['name' => 'Irish Coffee', 'price' => 5.00, 'category' => 'Irish Coffee', 'brand' => 'Lavazza', 'image' => 'irish_coffee.jpg', 'note' => 5, 'country' => 'Ireland', 'family' => 'Coffee', 'bestSeller' => true],
            ['name' => 'Vietnamese Coffee', 'price' => 3.75, 'category' => 'Vietnamese Coffee', 'brand' => 'Nespresso', 'image' => 'vietnamese_coffee.jpg', 'note' => 5, 'country' => 'Vietnam', 'family' => 'Coffee', 'bestSeller' => false],
            ['name' => 'Green Tea', 'price' => 2.50, 'category' => 'Green Tea', 'brand' => 'Illy', 'image' => 'green_tea.jpg', 'note' => 4, 'country' => 'China', 'family' => 'Tea', 'bestSeller' => true],
            ['name' => 'Black Tea', 'price' => 2.50, 'category' => 'Black Tea', 'brand' => 'Gloria Jean\'s Coffees', 'image' => 'black_tea.jpg', 'note' => 3, 'country' => 'India', 'family' => 'Tea', 'bestSeller' => false],
        ];

        foreach ($productsData as $data) {
            $product = new Product();
            $product->setName($data['name']);
            $product->setPrice($data['price']);
            $product->setCategory($manager->getRepository(Category::class)->findOneBy(['name' => $data['category']]));
            $product->setBrand($manager->getRepository(Brand::class)->findOneBy(['name' => $data['brand']]));
            $product->setImage($data['image']);
            $product->setNote($data['note']);
            $product->setCountry($data['country']);
            $product->setFamily($data['family']);
            $product->setBestSeller($data['bestSeller']);
            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
            BrandFixtures::class,
        ];
    }
}