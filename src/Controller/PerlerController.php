<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PaletteRepository;
use App\Repository\PerlerBrandsRepository;
use App\Entity\Palette;
use App\Entity\PatternImage;
use App\Utils\PaletteConverter;
use App\Form\PaletteType;
use App\Form\PatternImageType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

class PerlerController extends AbstractController
{
    /**
     * @Route("/perler", name="perler_index")
     */
    public function index()
    {
        return $this->render('perler/index.html.twig', [
            'controller_name' => 'PerlerPaletteController',
        ]);
    }

    /**
     * @Route("/perler/palette/new", name="perler_palette_new")
     */
    public function paletteNew(Request $req, ObjectManager $manager, Palette $palette = null)
    {
    	if($palette == null)
    	{
    		$palette = new Palette();
    	}

    	$form = $this->createForm(PaletteType::class, $palette);

    	$form->handleRequest($req);

    	if($form->isSubmitted()&&$form->isValid())
    	{
    		$manager->persist($palette);
    		$manager->flush();

    		return $this->redirectToRoute("perler_palette_display", [
    			'id' => $palette->getId()
    		]);
    	}

    	return $this->render('perler/editPalette.html.twig', [
    		'form' => $form->createView()
    	]);
    }

   	/**
   	 * @Route("/perler/palette/{id<\d+>}", name="perler_palette_display")
   	 * @Route("/perler/palette/default", name="perler_palette_default")
   	 */
   	public function paletteDisplay(PaletteRepository $paletteRepo, Palette $palette = null)
   	{
   		if($palette == null){
   			$palette = $paletteRepo->findAll()[0];
   		}

   		$paletteConverter = new PaletteConverter($palette);

   		$result = $paletteConverter->paletteToGpl();

   		return new Response("<body><pre>$result</pre></body>");
   	}

   	/**
   	 * @Route("/perler/pattern", name="perler_pattern")
     * @Route("/perler/pattern/{id<\d+>}", name="perler_pattern_image")
   	 */
   	public function Pattern(PaletteRepository $paletteRepo, PerlerBrandsRepository $brandsRepo, PatternImage $image = null)
   	{
   		$palette = $paletteRepo->findOneByName('Hama');
   		$brands = $brandsRepo->findAll();

   		for($i = 0 ; $i < count($brands) ; $i++)
   		{
   			$present = false;
   			foreach($palette->getColors() as $color)
   			{
   				if($color->getBrand() == $brands[$i]) $present = true;
   			}
   			if(!$present)
   			{
   				array_splice($brands, $i, 1);
   			}
   		}

   		return $this->render("perler/pattern.html.twig", [
   			'palette' => $palette,
   			'brands' => $brands,
        'image' => $image
   		]);
   	}

    /**
     * @Route("/perler/upload", name="perler_upload_image")
     */
    public function uploadImage(ObjectManager $manager, Request $req)
    {
      $image = new PatternImage();
      $form = $this->createForm(PatternImageType::class, $image);

      $form->handleRequest($req);

      if($form->isSubmitted()&&$form->isValid())
      {
        $file = $image->getName();
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move($this->getParameter('upload_directory'), $fileName);
        $image->setName($fileName);
        $image->setCreatedAt(new \Datetime);

        $manager->persist($image);
        $manager->flush();

        return $this->redirectToRoute('perler_pattern_image', ['id' => $image->getId()]);
      }

      return $this->render('perler/imageUpload.html.twig', [
        'form' => $form->createView(),
      ]);
    }
}