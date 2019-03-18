<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;
use Faker;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    	$faker = Faker\Factory::create();

    	for($i = 0 ; $i < 5 ; $i++)
    	{
    		$category = new Category();
    		$category->setName($faker->jobTitle());

            $manager->persist($category);
    	}

        $manager->flush();
    }
}
