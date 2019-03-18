<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PaletteRepository;
use App\Utils\PaletteConverter;

class PerlerPaletteController extends AbstractController
{
    /**
     * @Route("/perler/palette", name="perler_palette")
     */
    public function index()
    {
        return $this->render('perler_palette/index.html.twig', [
            'controller_name' => 'PerlerPaletteController',
        ]);
    }

   	/**
   	 * @Route("/perler/palette/display/", name="perler_palette_display")
   	 */
   	public function tohex(PaletteRepository $paletteRepo)
   	{
   		if(isset($_POST['palette'])){
   			$palette = $_POST['palette'];
   		}
   		else $palette = $paletteRepo->findAll()[0];

   		$paletteConverter = new PaletteConverter($palette);

   		$result = $paletteConverter->paletteToGpl();

   		return new Response("<body><pre>$result</pre></body>");
   	}
}
