<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\PerlerColors;
use App\Entity\Palette;


class PalettesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $colors = [
			["WHITE", "FFFFFF"],
			["SILVER", "C0C0C0"],
			["GRAY", "808080"],
			["BLACK", "000000"],
			["RED",	 "FF0000"],
			["MAROON", "800000"],
			["YELLOW", "FFFF00"],
			["OLIVE", "808000"],
			["LIME", "00FF00"],
			["GREEN", "008000"],
			["AQUA", "00FFFF"],
			["TEAL", "008080"],
			["BLUE", "0000FF"],
			["NAVY", "000080"],
			["FUCHSIA", "FF00FF"],
			["PURPLE", "800080"],
		];

		for($i = 0, $a = count($colors) ; $i < $a ; $i++)
		{
			$color = new PerlerColors();

			$color->setName($colors[$i][0])
				  ->setHex($colors[$i][1]);

			$manager->persist($color);
		}
        $manager->flush();

        $colorList = $manager->getRepository("App\Entity\PerlerColors")->findAll();

        $palette = new Palette();

        $palette->setName("test")
        		->setWidth(10);
        for ($i = 0, $a = count($colorList); $i < $a ; $i++)
        {
        	$palette->addColor($colorList[$i]);
        }
        $manager->persist($palette);
        $manager->flush();
    }
}
