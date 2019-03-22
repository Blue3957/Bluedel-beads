<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\PerlerColors;
use App\Entity\PerlerBrands;
use App\Entity\Palette;

use App\Utils\PaletteConverter;


class PalettesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $converter = new PaletteConverter();

    	$brands = [
    		"Perler",
    		"Hama",
    		"Ikea",
    		"Various"];

    	for($i = 0, $a = count($brands) ; $i < $a ; $i++)
    	{
    		$brand = new PerlerBrands();

    		$brand->setName($brands[$i]);

    		$manager->persist($brand);
    	}
    	$manager->flush();

    	$brandRepo = $manager->getRepository("App\Entity\PerlerBrands");

        $colors = [
			["WHITE", "FFFFFF"],
            ["SILVER", "C0C0C0"],
            ["GRAY", "808080"],
            ["BLACK", "000000"],
            ["RED",  "FF0000"],
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
            ["PURPLE", "800080"]
		];

        $hamaColors = [
            ["236 237 237",  "White",],
            ["240 232 185",  "Cream",],
            ["240 185 001",  "Yellow",],
            ["230 079 039",  "Orange",],
            ["182 049 054",  "Red",],
            ["225 136 159",  "Pink",],
            ["105 074 130",  "Purple",],
            ["044 070 144",  "Dark Blue (Blue)",],
            ["048 092 176",  "Light Blue",],
            ["037 104 071",  "Green",],
            ["073 174 137",  "Light green",],
            ["083 065 055",  "Brown",],
            ["192 036 053",  "Transparent Red",],
            ["055 184 118",  "Transparent Green",],
            ["131 136 138",  "Grey",],
            ["046 047 049",  "Black",],
            ["216 210 206",  "Clear",],
            ["127 051 042",  "Reddish Brown",],
            ["165 105 063",  "Light Brown",],
            ["165 045 054",  "Dark Red",],
            ["104 062 154",  "Translucent Purple",],
            ["135 089 061",  "Translucent Brown",],
            ["222 155 144",  "Flesh",],
            ["222 180 139",  "Beige",],
            ["054 063 056",  "Army (Dark Green)",],
            ["185 057 094",  "Claret",],
            ["089 047 056",  "Burgundy",],
            ["103 151 174",  "Turquoise",],
            ["255 032 141",  "Neon Pink (Fucsia)",],
            ["255 057 086",  "Cerise",],
            ["229 239 019",  "Neon Yellow",],
            ["255 040 051",  "Neon Red",],
            ["035 083 176",  "Neon Blue",],
            ["006 183 060",  "Neon Green",],
            ["253 134 000",  "Neon Orange",],
            ["241 242 028",  "Fluorescent Yellow",],
            ["254 099 011",  "Fluorescent Orange",],
            ["038 089 178",  "Fluorescent Blue",],
            ["012 189 081",  "Fluorescent Green",],
            ["240 234 055",  "Pastel Yellow",],
            ["238 105 114",  "Pastel Red",],
            ["136 109 185",  "Pastel Purple",],
            ["098 158 215",  "Pastel Blue",],
            ["131 203 112",  "Pastel Green",],
            ["207 112 183",  "Pastel Pink",],
            ["073 152 188",  "Azure"]
        ];


		for($i = 0, $a = count($colors) ; $i < $a ; $i++)
		{
			$color = new PerlerColors();

			$color->setName($colors[$i][0])
				  ->setHex($colors[$i][1])
				  ->setBrand($brandRepo->findOneByName('Various'))
				  ;

			$manager->persist($color);
		}

        for($i = 0, $a = count($hamaColors) ; $i < $a ; $i++)
        {
            $color = new PerlerColors();

            $color->setName($hamaColors[$i][1])
                  ->setHex($converter->RgbToHex($hamaColors[$i][0]))
                  ->setBrand($brandRepo->findOneByName('Hama'))
                  ;

            $manager->persist($color);
        }

        $manager->flush();

        $colorList = $manager->getRepository("App\Entity\PerlerColors")->findAll();

        $fullPalette = new Palette();

        $fullPalette->setName("Full Palette")
        		    ->setWidth(10);

        for ($i = 0, $a = count($colorList); $i < $a ; $i++)
        {
        	$fullPalette->addColor($colorList[$i]);
        }

        $manager->persist($fullPalette);

        $hamaPalette = new Palette();

        $hamaPalette->setName('Hama')
                    ->setWidth(10);

        $hamaColors = $manager->getRepository("App\Entity\PerlerColors")->findByBrand($brandRepo->findOneByName('Hama')->getId());

        for ($i = 0, $a = count($hamaColors); $i < $a ; $i++)
        {
            $hamaPalette->addColor($hamaColors[$i]);
        }

        $manager->persist($hamaPalette);

        $manager->flush();
    }
}
