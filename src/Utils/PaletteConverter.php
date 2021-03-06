<?php

namespace App\Utils;

class PaletteConverter
{
	private $palette;

	public function __construct($palette = null)
	{
		$this->palette = $palette;
	}

	private function hexToRgb($hex)
    {
    	if(strlen($hex) !== 6) return false;
    	$rgb = [];
    	$rgb[0] = base_convert(substr($hex, 0, 2), 16, 10);
    	$rgb[1] = base_convert(substr($hex, 2, 2), 16, 10);
    	$rgb[2] = base_convert(substr($hex, 4, 2), 16, 10);
    	return $rgb;
    }

    public function RgbToHex($rgb)
    {
        if(strlen($rgb) !== 11) return false;
        $hex1 = "" . base_convert(substr($rgb, 0, 3), 10, 16);
        if(strlen($hex1) < 2) $hex1 = "0" . $hex1;
        $hex2 = "" . base_convert(substr($rgb, 4, 3), 10, 16);
        if(strlen($hex2) < 2) $hex2 = "0" . $hex2;
        $hex3 = "" . base_convert(substr($rgb, 8, 3), 10, 16);
        if(strlen($hex3) < 2) $hex3 = "0" . $hex3;
        return $hex1 . $hex2 . $hex3;
    }

    public function paletteToGpl()
    {
    	$name = $this->palette->getName();
    	$columns = $this->palette->getWidth();
    	$comment = "# Palette for Perler/Hama beads patterns, created using Bluedel's Palette Converter\r\n";
    	$header = "GIMP Palette\r\n" .
    			   "Name: $name\r\n" .
    			   "Columns: $columns\r\n";
    	$colorList = $this->palette->getColors();
    	$colors = "";
    	foreach ($colorList as $color) {
    		$rgb = $this->HexToRgb($color->getHex());
            if($rgb !== false)
            {
        		$row = join(" ", $rgb) .
        			   "	" . $color->getName() . "\r\n";
        		$colors .= $row;
            }
    	}
    	$output = $header . $comment . $colors;
    	dump($output);
    	return $output;
    }

}

?>