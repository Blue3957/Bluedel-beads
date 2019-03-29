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
    		"Hama"];

    	for($i = 0, $a = count($brands) ; $i < $a ; $i++)
    	{
    		$brand = new PerlerBrands();

    		$brand->setName($brands[$i]);

    		$manager->persist($brand);
    	}
    	$manager->flush();

    	$brandRepo = $manager->getRepository("App\Entity\PerlerBrands");

        $perlerColors = [
            ['241 241 241', 'White'],
            ['224 222 169', 'Cream'],
            ['236 216 000', 'Yellow'],
            ['237 097 032', 'Orange'],
            ['191 046 064', 'Red'],
            ['221 102 155', 'Bubblegum'],
            ['096 064 137', 'Purple'],
            ['043 063 135', 'Dark Blue'],
            ['051 112 192', 'Light Blue'],
            ['028 117 062', 'Dark Green'],
            ['249 126 121', 'Pearl Coral'],
            ['122 174 162', 'Pearl Light Blue'],
            ['132 183 145', 'Pearl Green'],
            ['202 192 051', 'Pearl Yellow'],
            ['215 168 162', 'Pearl Light Pink'],
            ['119 123 129', 'Silver'],
            ['086 186 159', 'Light Green'],
            ['081 057 049', 'Brown'],
            ['138 141 145', 'Grey'],
            ['046 047 050', 'Black'],
            ['140 055 044', 'Rust'],
            ['129 093 052', 'Light Brown'],
            ['238 186 178', 'Peach'],
            ['188 147 113', 'Tan'],
            ['242 042 123', 'Magenta'],
            ['220 224 002', 'Neon Yellow'],
            ['255 119 000', 'Neon Orange'],
            ['001 158 067', 'Neon Green'],
            ['255 057 145', 'Neon Pink'],
            ['083 144 209', 'Pastel Blue'],
            ['118 200 130', 'Pastel Green'],
            ['138 114 193', 'Pastel Lavender'],
            ['254 248 117', 'Pastel Yellow'],
            ['241 170 012', 'Chedder'],
            ['147 200 212', 'Toothpaste'],
            ['255 056 081', 'Hot Coral'],
            ['162 075 156', 'Plum'],
            ['108 190 019', 'Kiwi Lime'],
            ['043 137 198', 'Cyan (aka Turquoise)'],
            ['255 130 133', 'Blush'],
            ['100 124 190', 'Periwinkle Blue'],
            ['190 198 150', 'Glow Green'],
            ['246 179 221', 'Light Pink'],
            ['079 173 066', 'Bright Green'],
            ['177 181 178', 'Light Gray'],
            ['053 083 067', 'Evergreen'],
            ['173 152 212', 'Lavender'],
            ['228 072 146', 'Pink'],
            ['187 118 052', 'Gold'],
            ['165 048 097', 'Raspberry'],
            ['212 132 055', 'Butterscotch'],
            ['006 124 129', 'Parrot Green'],
            ['077 081 086', 'Dark Grey'],
            ['130 151 217', 'Blueberry Cream'],
            ['128 050 069', 'Cranapple'],
            ['189 218 001', 'Prickly Pear'],
            ['228 182 144', 'Sand']
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

        for($i = 0, $a = count($perlerColors) ; $i < $a ; $i++)
        {
            $color = new PerlerColors();

            $color->setName($perlerColors[$i][1])
                  ->setHex($converter->RgbToHex($perlerColors[$i][0]))
                  ->setBrand($brandRepo->findOneByName('Perler'))
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
