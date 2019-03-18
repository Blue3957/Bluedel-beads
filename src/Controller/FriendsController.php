<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FriendsRepository;

class FriendsController extends AbstractController
{
    /**
     * @Route("/friends", name="friends_index")
     */
    public function index(FriendsRepository $repo)
    {
    	$friends = $repo->findAll();
    	dump($friends);
        return $this->render('friends/index.html.twig', ["friends" => $friends]);
    }

    /**
     * @Route("/friends/{id<\d+>}", name="friends_detail")
     */
    public function detail(FriendsRepository $repo, $id)
    {
    	$friend = $repo->findOneById($id);
    	return $this->render('friends/detail.html.twig', ['friend' => $friend]);
    }
}
