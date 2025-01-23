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
            ['name' => 'Espresso', 'price' => 2.50, 'category' => 'Espresso', 'brand' => 'Starbucks', 'image' => 'images/espresso.webp', 'note' => 5, 'country' => 'Italy', 'family' => 'Coffee', 'bestSeller' => false],
            ['name' => 'Latte', 'price' => 3.50, 'category' => 'Latte', 'brand' => 'Costa Coffee', 'image' => 'images/Latte.jpg', 'note' => 4, 'country' => 'Italy', 'family' => 'Coffee', 'bestSeller' => false],
            ['name' => 'Cappuccino', 'price' => 3.00, 'category' => 'Cappuccino', 'brand' => 'Dunkin\' Donuts', 'image' => 'images/devin-avery-BVuXUt4Q43o-unsplash.jpg', 'note' => 4, 'country' => 'Italy', 'family' => 'Coffee', 'bestSeller' => true],
            ['name' => 'Americano', 'price' => 2.75, 'category' => 'Americano', 'brand' => 'Peet\'s Coffee', 'image' => 'images/ross-parmly-IWZX30xASYQ-unsplash.jpg', 'note' => 3, 'country' => 'USA', 'family' => 'Coffee', 'bestSeller' => false],
            ['name' => 'Mocha', 'price' => 3.75, 'category' => 'Mocha', 'brand' => 'Tim Hortons', 'image' => 'images/tavis-beck-mAAcR1LR0mo-unsplash.jpg', 'note' => 5, 'country' => 'USA', 'family' => 'Coffee', 'bestSeller' => true],
            ['name' => 'Macchiato', 'price' => 3.25, 'category' => 'Macchiato', 'brand' => 'Caribou Coffee', 'image' => 'images/jeremy-yap-jn-HaGWe4yw-unsplash.jpg', 'note' => 4, 'country' => 'Italy', 'family' => 'Coffee', 'bestSeller' => false],
            ['name' => 'Flat White', 'price' => 3.50, 'category' => 'Flat White', 'brand' => 'Lavazza', 'image' => 'images/seyfettin-dincturk-vgovkwqngxE-unsplash.jpg', 'note' => 4, 'country' => 'Australia', 'family' => 'Coffee', 'bestSeller' => true],
            ['name' => 'Cold Brew', 'price' => 4.00, 'category' => 'Cold Brew', 'brand' => 'Nespresso', 'image' => 'images/bennie-bates-XJEhauuTdCE-unsplash.jpg', 'note' => 5, 'country' => 'USA', 'family' => 'Coffee', 'bestSeller' => false],
            ['name' => 'Frappuccino', 'price' => 4.50, 'category' => 'Frappuccino', 'brand' => 'Illy', 'image' => 'images/victor-rutka-eUwxwA6JTFM-unsplash.jpg', 'note' => 5, 'country' => 'USA', 'family' => 'Coffee', 'bestSeller' => true],
            ['name' => 'Tea', 'price' => 2.00, 'category' => 'Tea', 'brand' => 'Gloria Jean\'s Coffees', 'image' => 'images/thought-catalog-OJZB0VUQKKc-unsplash.jpg', 'note' => 3, 'country' => 'China', 'family' => 'Tea', 'bestSeller' => false],
            ['name' => 'Hot Chocolate', 'price' => 3.00, 'category' => 'Hot Chocolate', 'brand' => 'Starbucks', 'image' => 'images/elena-leya-NtmNhrdfs-o-unsplash.jpg', 'note' => 4, 'country' => 'USA', 'family' => 'Chocolate', 'bestSeller' => true],
            ['name' => 'Chai Latte', 'price' => 3.50, 'category' => 'Chai Latte', 'brand' => 'Costa Coffee', 'image' => 'images/toa-heftiba-1CAFw4Yz_4w-unsplash.jpg', 'note' => 4, 'country' => 'India', 'family' => 'Tea', 'bestSeller' => false],
            ['name' => 'Matcha Latte', 'price' => 4.00, 'category' => 'Matcha Latte', 'brand' => 'Dunkin\' Donuts', 'image' => 'images/alana-harris-C63YZ33DdvY-unsplash.jpg', 'note' => 5, 'country' => 'Japan', 'family' => 'Tea', 'bestSeller' => true],
            ['name' => 'Iced Coffee', 'price' => 3.00, 'category' => 'Iced Coffee', 'brand' => 'Peet\'s Coffee', 'image' => 'images/eiliv-aceron-_tSgUmeYMm8-unsplash.jpg', 'note' => 4, 'country' => 'USA', 'family' => 'Coffee', 'bestSeller' => false],
            ['name' => 'Affogato', 'price' => 4.50, 'category' => 'Affogato', 'brand' => 'Tim Hortons', 'image' => 'images/ieva-kisunaite-kRS7qyKfVhY-unsplash.jpg', 'note' => 5, 'country' => 'Italy', 'family' => 'Coffee', 'bestSeller' => false],
            ['name' => 'Turkish Coffee', 'price' => 3.25, 'category' => 'Turkish Coffee', 'brand' => 'Caribou Coffee', 'image' => 'images/yuriy-vinnicov-njqR4l-lBHk-unsplash.jpg', 'note' => 4, 'country' => 'Turkey', 'family' => 'Coffee', 'bestSeller' => false],
            ['name' => 'Irish Coffee', 'price' => 5.00, 'category' => 'Irish Coffee', 'brand' => 'Lavazza', 'image' => 'images/anna-kumpan-sd-5ILZcTZ0-unsplash.jpg', 'note' => 5, 'country' => 'Ireland', 'family' => 'Coffee', 'bestSeller' => false],
            ['name' => 'Vietnamese Coffee', 'price' => 3.75, 'category' => 'Vietnamese Coffee', 'brand' => 'Nespresso', 'image' => 'images/tu-ngoc-minh-blQLC6CT36Q-unsplash.jpg', 'note' => 5, 'country' => 'Vietnam', 'family' => 'Coffee', 'bestSeller' => false],
            ['name' => 'Green Tea', 'price' => 2.50, 'category' => 'Green Tea', 'brand' => 'Illy', 'image' => 'images/anna-zakharova-pqVayRmrJAQ-unsplash.jpg', 'note' => 4, 'country' => 'China', 'family' => 'Tea', 'bestSeller' => false],
            ['name' => 'Black Tea', 'price' => 2.50, 'category' => 'Black Tea', 'brand' => 'Gloria Jean\'s Coffees', 'image' => 'images/petr-sidorov-zNQQcuPJu04-unsplash.jpg', 'note' => 3, 'country' => 'India', 'family' => 'Tea', 'bestSeller' => false],
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