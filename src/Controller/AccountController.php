<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Trick;
use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{
    #[Route('/mon_compte', name: 'app_account')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $toget = ['User'=> User::class, 'Trick'=> Trick::class, 'Comment'=> Comment::class];
        $toset = [];

        foreach($toget as $name=> $class) {
            
            $repo = $entityManager->getRepository($class);
            $el = $repo->createQueryBuilder('a')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();
            $toset[$name] = $el;
        }

        $alltricks = $entityManager->getRepository(Trick::class)->findBy([], ['createdAt' => 'DESC'], 10);

        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
            'user' => $this->getUser(),
            'users' => $toset['User'],
            'tricks' => $toset['Trick'],
            'comments' => $toset['Comment'],
            'alltricks' => $alltricks
        ]);
    }
}
