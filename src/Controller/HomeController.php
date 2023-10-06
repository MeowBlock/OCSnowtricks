<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_trick_index', methods: ['GET'])]
    public function index(TrickRepository $trickRepository): Response
    {
        $tricks = $trickRepository->findAll();
        $card = [
            'user'=>[
                'title'=>'trick',
                'avatar' => 'https://placehold.co/60x60'
            ],
            'content' => 'blabla bonjour',
            'image' => 'https://placehold.co/600x400'
        ];
        // return $this->render('trick/index.html.twig', [
        // 'tricks' => $trickRepository->findAll(),
        // ]);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'card' => $card,
            'tricks' => $tricks
        ]);
    }
}
