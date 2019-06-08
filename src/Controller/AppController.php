<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FriendsRepository;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index()
    {
        return $this->render('app/index.html.twig');
    }
    /**
     * @Route("/test", name="sql_injection_test")
     */
    public function test(FriendsRepository $repo)
    {
    	$variable = $repo->findOneByName('Christine de la Poulain');
    	dump($variable);
     	return $this->render('app/test.html.twig', ['variable' => $variable]);
    }
}
