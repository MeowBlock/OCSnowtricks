<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Loader\ArrayLoader;
use Twig\Loader\FilesystemLoader;
use App\Repository\TrickRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public $itemsPerPage = 15;



    #[Route('/', name: 'app_trick_index', methods: ['GET'])]
    public function index(TrickRepository $trickRepository): Response
    {

        $tricks = $trickRepository->findBy([], ['createdAt'=> 'DESC'], $this->itemsPerPage);
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

    #[Route('/api/getTricks', name: 'api_trick_index', methods: ['GET'])]
    public function getTricks(TrickRepository $trickRepository): Response
    {
        $request = Request::createFromGlobals();
        $page = $request->query->get('page', 1);

        $tricks = $trickRepository->findBy([], ['createdAt'=> 'DESC'], $this->itemsPerPage * $page,  $this->itemsPerPage * ($page-1));
        $card = [
            'user'=>[
                'title'=>'trick',
                'avatar' => 'https://placehold.co/60x60'
            ],
            'content' => 'blabla bonjour',
            'image' => 'https://placehold.co/600x400'
        ];
        return $this->render('home/_partial_tricklist.html.twig', [
            'controller_name' => 'HomeController',
            'card' => $card,
            'tricks' => $tricks
        ]);
    }
}
