<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Friends;
use App\Repository\CategoryRepository;
use Faker;

class FriendsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $categoryList = $manager->getRepository("App\Entity\Category")->findAll();

    	for($i = 0 ; $i < 20 ; $i++)
    	{
    		$friend = new Friends();
    		$friend->setName($faker->name)
    			   ->setText($faker->paragraph)
    			   ->setImage($faker->imageUrl(300, 300))
                   ->setCategory($categoryList[random_int(0, count($categoryList)-1)]);
    		$manager->persist($friend);
    	}

        $manager->flush();
    }
}
